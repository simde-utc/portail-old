<?php
class GesmailBox {
  public $asso;
  public $extension;
  public $type;
  public $idbox = -1;
  
  public function __construct($asso, $ext = ""){
    $this->asso = $asso;
    
    if(!empty($ext))
      $this->extension = $ext;
    
    $pdo = Doctrine_Manager::getInstance()
       ->getConnection('gesmail')
       ->getDbh();
    
    if(!empty($ext)){
      $login = $pdo->quote($this->asso);
      $extension = $pdo->quote($ext);
      $req = $pdo->query("SELECT ID, Extension, Type FROM gesmail WHERE Asso LIKE $login AND Extension LIKE $extension")->fetch(PDO::FETCH_ASSOC);
    }
    
    if(!empty($ext) && !empty($req)){
      $this->type = $req['Type'];
      $this->extension = $req['Extension'];
      $this->idbox = $req['ID'];
    }
    elseif(empty($ext)) {
      $this->type = "alias";
    }
  }
  
  public function getName(){
    if(!empty($this->extension))
      return $this->asso.'-'.$this->extension;
    else
      return $this->asso;
  }
  
  public function getTypeLu(){
    if($this->type == "alias")
      return "redirection";
    else if($this->type == "ml")
      return "mailing-liste";
  }
  
  public function getDestinataires(){
    $pdo = Doctrine_Manager::getInstance()
       ->getConnection('gesmail')
       ->getDbh();
    
    if($this->type == "alias"){
      $alias = $pdo->quote($this->getName());
      $login = $pdo->quote($this->asso);
      return $pdo->query("SELECT ID, destination FROM postfix_alias WHERE alias LIKE $alias AND destination NOT LIKE $login")->fetchAll(PDO::FETCH_OBJ);
    }
    elseif($this->type == "ml"){
      $ml = $pdo->quote($this->getName());
      return $pdo->query("SELECT address AS destination FROM mailman_mysql WHERE listname LIKE $ml")->fetchAll(PDO::FETCH_OBJ);
    }
  }
  
  public function getEmail(){
    return $this->getName()."@assos.utc.fr";
  }
  
  public function deleteDest($email){
    $pdo = Doctrine_Manager::getInstance()
       ->getConnection('gesmail')
       ->getDbh();
    
    $alias = $pdo->quote($this->getName());
    $email = $pdo->quote($email);
    
    if($this->type == "alias")
      return $pdo->query("DELETE FROM postfix_alias WHERE alias LIKE $alias AND destination LIKE $email")->execute();
    elseif($this->type == "ml")
      return $pdo->query("DELETE FROM mailman_mysql WHERE listname LIKE $alias AND address LIKE $email")->execute();
  }
  
  public function addDest($email){
    $pdo = Doctrine_Manager::getInstance()
       ->getConnection('gesmail')
       ->getDbh();
    
    if(!$this->verifMail($email))
      return 1;
    
    if($email == $this->getEmail())
      return 2;

    
    $alias = $pdo->quote($this->getName());
    $email = $pdo->quote($email);
    $pass = $pdo->quote($this->genpass());
    
    if($this->type == "alias")
      $q = $pdo->query("INSERT IGNORE INTO postfix_alias (alias,destination) VALUES ($alias,$email)");
    elseif($this->type == "ml")
      $q = $pdo->query("INSERT IGNORE INTO mailman_mysql (listname, address, hide, nomail, ack, not_metoo, digest, plain, password, lang, name, one_last_digest, user_options, delivery_status, topics_userinterest, delivery_status_timestamp, bi_cookie, bi_score, bi_noticesleft, bi_lastnotice, bi_date) VALUES ($alias, $email, 'N', 'N', 'Y', 'Y', 'N', 'N', $pass, 'fr', '', 'N', '264', '0', NULL, '0000-00-00 00:00:00', NULL, '0', '0', '0000-00-00', '0000-00-00')");
    
    if($q->rowCount() == 0)
      return 3;
    
    return 0;
  }
  
  private function verifMail($email){
    return preg_match('#^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$#i', $email);
  }
  
  private function genpass(){
    $s = "abcdefghijklmnopqrstuvwxyz";
    $str = "";
    for($i=0;$i<8;$i++)
      $str .= $s[rand(0,25)];
    return $str;
  }
}
?>
