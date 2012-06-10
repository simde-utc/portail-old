<?php

class Gesmail {
  protected $asso;
  
  public function setAsso($asso){
    $this->asso = $asso;
  }
  public function getBoxes(){
    $pdo = Doctrine_Manager::getInstance()
       ->getConnection('gesmail')
       ->getDbh();
    $login = $pdo->quote($this->asso->getLogin());
    $aliases = $pdo->query("SELECT ID, Extension FROM gesmail WHERE Asso LIKE $login AND Type LIKE 'alias'")->fetchAll(PDO::FETCH_ASSOC);
    $mls = $pdo->query("SELECT ID, Extension FROM gesmail WHERE Asso LIKE $login AND Type LIKE 'ml'")->fetchAll(PDO::FETCH_ASSOC);
    return array('alias' => $aliases, 'ml' => $mls);
  }
  
  public function getBox($box){
    $pdo = Doctrine_Manager::getInstance()
       ->getConnection('gesmail')
       ->getDbh();
    $login = $pdo->quote($this->asso->getLogin());
    $box = intval($box);
    if($box > 0){
      $req = $pdo->query("SELECT Extension, Type FROM gesmail WHERE Asso LIKE $login AND ID = $box")->fetchAll(PDO::FETCH_ASSOC);
      $type = $req['Type'];
      $box = $login."-".$req['Extension'];
    }
    else {
      $type = "alias";
      $box = $login;
    }
    
    if($type == 'alias')  
      $typelu = 'redirection';
    else if($type == 'ml')
      $typelu = 'mailing-liste';
      
    return array('name' => $box, 'type' => $type, 'typelu' => $typelu);
  }
  
  public function getAliasContents($boxid){
    $pdo = Doctrine_Manager::getInstance()
       ->getConnection('gesmail')
       ->getDbh();
    $login = $pdo->quote($this->asso->getLogin());
    $box = $this->getBox($boxid);
    return $pdo->query("SELECT ID, destination FROM postfix_alias WHERE alias LIKE ".$box['name']." AND destination NOT LIKE $login")->fetchAll(PDO::FETCH_ASSOC);
  }
}
?>
