<?php

class Gesmail {
  protected $asso;
  
  public function __construct($asso){
    $this->setAsso($asso);
  }
  
  public function setAsso($asso){
    $this->asso = $asso;
  }
  public function getBoxes(){
    $pdo = Doctrine_Manager::getInstance()
       ->getConnection('gesmail')
       ->getDbh();
    
    $login = $pdo->quote($this->asso->getLogin());
    $query = $pdo->query("SELECT Extension, Type FROM gesmail WHERE Asso LIKE $login");
    
    while($res = $query->fetchObject())
      $return[$res->Type][] = new GesmailBox($this->asso, $res->Extension);

    return $return;
  }
  
  public function getBox($box){
    return new GesmailBox($this->asso->getLogin(), $box);
  }
  
  public function getBoxByID($boxid){
    if($boxid == -1)
      return new GesmailBox($this->asso->getLogin());
    
    
    $pdo = Doctrine_Manager::getInstance()
       ->getConnection('gesmail')
       ->getDbh();
    
    $login = $pdo->quote($this->asso->getLogin());
    $boxid = intval($boxid);
    $query = $pdo->query("SELECT Extension FROM gesmail WHERE Asso LIKE $login AND ID = $boxid")->fetchObject();
    
    return new GesmailBox($this->asso->getLogin(), $query->Extension);
  }
  
}
?>
