<?php

/**
 * Reservation form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ReservationForm extends BaseReservationForm
{

  public function configure()
  { 
 
     if($this->getOption('PoleId')!=1){ // salle spécifique à un pôle.
      
      // préparation du tableau associatif regroupant les id et les noms des assos de l'utilisateur pour le pôle de la salle concernée
      $choices=array();
      $c = AssoTable::getInstance()->getMyAssosNameByIdSalle($this->getOption('UserID'),$this->getOption('idSalle'))->execute();
      foreach($c as $asso){
      $choices= $choices + array($asso->getId() => $asso->getName());
      }

      // Préparation des données pour la suite de l'algo
      $Salle = SalleTable::getInstance()->getSalleById($this->getOption('idSalle'))->fetchOne();
      $PoleLogin = $Salle->getPole()->getAssoId();
      $PoleName = AssoTable::getInstance()->getOneById($PoleLogin)->fetchOne()->getName();
      $PoleId = AssoTable::getInstance()->getOneById($PoleLogin)->fetchOne()->getId();
      $myAssos = AssoTable::getInstance()->getMyAssos($this->getOption('UserID'))->execute();
      
      // Constitution du tableau d'ID des assos de l'utilisateur.
      $ma=array();
      foreach($myAssos as $a){
      $ma= $ma+array($a->getId() => $a->getName());
      }

      // Si l'utilisateur appartient au pôle, on ajoute le pôle aux choix possibles.
      if (in_array($PoleName, $ma)) {
    $choices= $choices + array($PoleId=> $PoleName);
      }
    
      $this->widgetSchema['id_asso'] = new sfWidgetFormChoice(array('choices' => $choices));
      
    
    }
    else{
      $choices=array();
      $myAssos = AssoTable::getInstance()->getMyAssos($this->getOption('UserID'))->execute();

      
      // Constitution du tableau d'ID des assos de l'utilisateur.
      $ma=array();
      foreach($myAssos as $a){
      $ma= $ma+array($a->getId() => $a->getName());
      }
      $ma = $ma+array(""=>"");
      $this->widgetSchema['id_asso'] = new sfWidgetFormChoice(array('choices' => $ma));

      
     }
    
       
     $this->widgetSchema['id_user_valid'] = new sfWidgetFormInputHidden();
     $this->widgetSchema['id_salle'] = new sfWidgetFormInputHidden();
     $this->widgetSchema['id_user_reserve'] = new sfWidgetFormInputHidden();
     $this->widgetSchema['estvalide'] = new sfWidgetFormInputHidden();
     $this->widgetSchema['date'] = new sfWidgetFormDate(array('format'=>'%day%/%month%/%year%','can_be_empty'=>false));  
     $this->widgetSchema['heuredebut'] = new sfWidgetFormTime(array('can_be_empty'=>false));
     
     
    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_user_valid'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserValide'), 'required' => false)),
      'id_user_reserve' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserReserve'))),
      'id_asso'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Asso'), 'required' => false)),
      'id_salle'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Salle'))),
      'date'            => new sfValidatorDate(),
      'heuredebut'      => new sfValidatorTime(array('required' => false)),
      'heurefin'        => new sfValidatorTime(array('required' => false)),
      'allday'          => new sfValidatorBoolean(),
      'activite'        => new sfValidatorString(array('max_length' => 255)),
      'estvalide'       => new sfValidatorBoolean(),
      'commentaire'     => new sfValidatorString(array('required' => false)),
    ));
     
     $types = array(
    'Réunion' => 'Réunion',
    'Logistique' => 'Logistique',
    'Autre' => 'Autre',
     );
     
     $this->widgetSchema['activite'] = new sfWidgetFormChoice(array(
    'choices'  => $types,
      ));
    


     $years = range(date('Y'), date('Y') + 2);
     $this->getWidget('date')->addOption('years', array_combine($years, $years));
     $lminutes = array(0,30);
     $minutes = array(sprintf("%02d",0),30);

     $hours = array(sprintf("%02d",8),sprintf("%02d",9),10,11,12,13,14,15,16,17,18,19,20,21,22,23);
     $this->getWidget('heuredebut')->addOption('minutes', array_combine($lminutes, $minutes));
     $this->getWidget('heuredebut')->addOption('hours', array_combine(range(8,23),$hours));
     $this->getWidget('heurefin')->addOption('minutes', array_combine($lminutes, $minutes));
     $this->getWidget('heurefin')->addOption('hours', array_combine(range(8,23), $hours));
     
     $this->getWidget('date')->setLabel('Date:');
     $this->getWidget('heuredebut')->setLabel('Créneau:');
     $this->getWidget('activite')->setLabel('Activité:');
     $this->getWidget('id_asso')->setLabel('Association:');
     $this->getWidget('allday')->setLabel('Jour entier:');
     
    
    $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
  new sfValidatorCallback(array('callback' => array($this, 'checkTempsMinDeReservation'))),
  new sfValidatorCallback(array('callback' => array($this, 'checkPeutReserver'))),
  new sfValidatorCallback(array('callback' => array($this, 'checkCreneauDansLePasse'))),
  new sfValidatorCallback(array('callback' => array($this, 'checkCreneauLibre'))),
  new sfValidatorCallback(array('callback' => array($this, 'checkLimiteMax'))),
  new sfValidatorCallback(array('callback' => array($this, 'checkJourLibre'))),
  new sfValidatorCallback(array('callback' => array($this, 'checkHeureDebutAvantHeureFin'))),
    )));
      
  }
 // Permet de savoir si le temps de réservation est supérieur à une limite minimum de 30mn.
  public function checkTempsMinDeReservation($validator, $values)
  {
    if($values['allday']==false){
    
      $heureDeb= new DateTime($values['heuredebut']) ;
      $heureFin= new DateTime($values['heurefin']) ;
      $diff = $heureFin->diff($heureDeb);
      
      if ($diff->h==0 && $diff->i==0)
      {
  // créneau trop court
  throw new sfValidatorError($validator, 'Créneau d\'au minimum 30mn');
      }
    
    }
 
    // créneau correct, on retourne les données nettoyées
    return $values;
  }
  

  // permet de savoir si la réservation se fait au moins une heure avant l'heure de réservation demandée.
  public function checkPeutReserver($validator, $values)
  { 
    $d= new DateTime();
    $a=new DateTime($values['date']." ".$values['heuredebut']);
    $diff = $a->diff($d);
    
    if($diff->y==0 and $diff->m==0 and $diff->d==0 and $diff->h==0 and $diff->i<59){
    throw new sfValidatorError($validator, 'Vous devez effectuer la réservation au moins une heure avant le début du créneau.');
    }
    return $values;

  }

  
  
  
  
  // permet de savoir si le créneau se situe bien dans le futur.
  public function checkCreneauDansLePasse($validator, $values)
  { 
    //date_default_timezone_set('Europe/Paris');
    $d= new DateTime();

    $a=new DateTime($values['date']." ".$values['heuredebut']);
    
    if($a<$d){
    throw new sfValidatorError($validator, 'Créneau dans le passé, impossible de réserver.');
    }
    
    return $values;

  }
  
  
  
  
  
  // Permet de savoir s'il n'y a pas déjà une réservation à l'heure et à la date demandée.
  public function checkCreneauLibre($validator, $values)
  { 
    if($values['id']==NULL){
    
    $r1= ReservationTable::getInstance()->isChevauchementFin($values['date'],$values['id_salle'],$values['heuredebut'],$values['heurefin'])->fetchOne();
    $result1=$r1["count"];
    $r2= ReservationTable::getInstance()->isChevauchementDebut($values['date'],$values['id_salle'],$values['heuredebut'],$values['heurefin'])->fetchOne();
    $result2=$r2["count"];
    $r3= ReservationTable::getInstance()->isChevauchementInterne($values['date'],$values['id_salle'],$values['heuredebut'],$values['heurefin'])->fetchOne();
    $result3=$r3["count"];
    
    }
    else{
    
    $r1= ReservationTable::getInstance()->isChevauchementFinUpdate($values['date'],$values['id_salle'],$values['heuredebut'],$values['heurefin'],$values['id'])->fetchOne();
    $result1=$r1["count"];
    $r2= ReservationTable::getInstance()->isChevauchementDebutUpdate($values['date'],$values['id_salle'],$values['heuredebut'],$values['heurefin'],$values['id'])->fetchOne();
    $result2=$r2["count"];
    $r3= ReservationTable::getInstance()->isChevauchementInterneUpdate($values['date'],$values['id_salle'],$values['heuredebut'],$values['heurefin'],$values['id'])->fetchOne();
    $result3=$r3["count"];
    
    }
    
    if($result1!="0" or $result2!="0" or $result3!="0"){
    throw new sfValidatorError($validator, 'Ce créneau n\'est pas libre, merci de consulter le calendrier et de choisir un créneau libre.');
    }
    
    return $values;

  }
  
  
  
  // Permet de voir si la limite de 3h maximum par jour par asso n'est pas atteinte.
  public function checkLimiteMax($validator, $values)
  { 
    if($values['id_asso']!=NULL){
  if($values['id']!=NULL){
      $q = ReservationTable::getInstance()->getReservationPourAssoPourDateUpdate($values['id_asso'],$values['date'],$values['id']);
  }
  else{
      $q = ReservationTable::getInstance()->getReservationPourAssoPourDate($values['id_asso'],$values['date']);
  }
  
  $result= $q->execute();
  
  $h=0;
  $m=0;
        
  if($result)
  {
    foreach($result as $res)
    {
      $d=new DateTime($res->getDate()." ".$res->getHeureDebut());
      $f=new DateTime($res->getDate()." ".$res->getHeureFin());
      $diff = $f->diff($d);
      $h+=$diff->h;
      $m+=$diff->i;

    }
  }
            
  $d=new DateTime($values['date']." ".$values['heuredebut']);
  $f=new DateTime($values['date']." ".$values['heurefin']);
  $diff = $f->diff($d);
  $h+=$diff->h;
  $m+=$diff->i;
  
  $h+=(int)($m/60);
  $m=$m%60;

  
  if($h>3 or ($h==3 and $m!=0)){
        throw new sfValidatorError($validator, 'Vous ne pouvez pas réserver plus de 3h dans une même journée pour la même association.');
  }
    }
    else{
  $heureDeb= new DateTime($values['heuredebut']) ;
  $heureFin= new DateTime($values['heurefin']) ;
  $diff = $heureFin->diff($heureDeb);
  if ($diff->h>3 or ($diff->h==3 and $diff->i!=0))
  {
    // créneau trop long
    throw new sfValidatorError($validator, 'Créneau trop large, 3 heures max.');
  }
    
    }
    return $values;

  }
  
  
  
  
  
  // Permet de savoir s'il n'y a pas une réservation Allday à la date demandée.
  public function checkJourLibre($validator, $values)
  { 
      if($values['id']!=NULL){
    $q = ReservationTable::getInstance()->isJourLibreUpdate($values['date'],$values['id_salle'],$values['id']);
      }
      else{
    $q = ReservationTable::getInstance()->isJourLibre($values['date'],$values['id_salle']);
      }


    $r= $q->fetchOne();
    $result=$r["count"];
    
    if($result>0){
    throw new sfValidatorError($validator, 'Impossible de valider, cette salle a été réservée toute la journée.');
    }
    
    return $values;

  }
  
  
  public function checkHeureDebutAvantHeureFin($validator, $values)
  { 
    
    if($values['allday']==false){
    
      if($values['heurefin']==""){
    throw new sfValidatorError($validator, 'Merci de rentrer une heure de fin.');
      }
      if($values['heuredebut']>$values['heurefin']){
    throw new sfValidatorError($validator, 'L\'heure de début doit précéder l\'heure de fin.');
      }
    
    }

    return $values;

  }
  

  
  
  
  
}
