<?php
class GesmailBox {
  public $asso;
  public $extension;
  public $type;
  
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
      $req = $pdo->query("SELECT Extension, Type FROM gesmail WHERE Asso LIKE $login AND Extension LIKE $extension")->fetch(PDO::FETCH_ASSOC);
    }
    
    if(!empty($ext) && !empty($req)){
      $this->type = $req['Type'];
      $this->extension = $req['Extension'];
    }
    else {
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
}
?>
