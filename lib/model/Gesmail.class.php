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
  
  public function createBox($ext, $type){
    $pdo = Doctrine_Manager::getInstance()
       ->getConnection('gesmail')
       ->getDbh();
    
    if(!preg_match('#^[a-z0-9]+$#', $ext))
      return 2;
    
    $asso = $pdo->quote($this->asso->getLogin());
    $extension = $pdo->quote($ext);
    
    if($type == "alias")
      $q = $pdo->query("INSERT IGNORE INTO gesmail (Asso, Extension, Type) VALUES ($asso, $extension, 'alias')");
    elseif($type == "ml")
      $q = $pdo->query("INSERT IGNORE INTO gesmail (Asso, Extension, Type) VALUES ($asso, $extension, 'ml')");
    
    if($q->rowCount() == 1)
      return 0;
    else
      return 1; // Adresse existe déjà
  }
}
?>
