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
     if($this->getOption('PoleId')!=1){
	  $query = AssoTable::getInstance()->getMyAssosNameByIdSalle($this->getOption('UserID'),$this->getOption('idSalle'));

     }
     else{
	  $query = AssoTable::getInstance()->getMyAssos($this->getOption('UserID'));
     }
     
    $this->widgetSchema['id_asso'] = new sfWidgetFormDoctrineChoice(array(
		'model' => $this->getRelatedModelName('Asso'), 
		'query' => $query 
    ));
     
     
    
     $this->widgetSchema['id_user_valid'] = new sfWidgetFormInputHidden();
     $this->widgetSchema['id_salle'] = new sfWidgetFormInputHidden();
     $this->widgetSchema['id_user_reserve'] = new sfWidgetFormInputHidden();
     $this->widgetSchema['estvalide'] = new sfWidgetFormInputHidden();
     $this->widgetSchema['date'] = new sfWidgetFormDate(array('format'=>'%day%/%month%/%year%','can_be_empty'=>false));	
     $this->widgetSchema['heuredebut'] = new sfWidgetFormTime(array('can_be_empty'=>false));
     
     
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
     $lminutes = [0,30];
     $minutes = [sprintf("%02d",0),30];

     $hours = [sprintf("%02d",8),sprintf("%02d",9),10,11,12,13,14,15,16,17,18,19,20,21,22,23];
     $this->getWidget('heuredebut')->addOption('minutes', array_combine($lminutes, $minutes));
     $this->getWidget('heuredebut')->addOption('hours', array_combine(range(8,23),$hours));
     $this->getWidget('heurefin')->addOption('minutes', array_combine($lminutes, $minutes));
     $this->getWidget('heurefin')->addOption('hours', array_combine(range(8,23), $hours));
     
     $this->getWidget('date')->setLabel('Date:');
     $this->getWidget('heuredebut')->setLabel('Créneau:');
     $this->getWidget('activite')->setLabel('Activité:');
     $this->getWidget('id_asso')->setLabel('Association:');
     $this->getWidget('allday')->setLabel('Jour entier:');
     
     $this->validatorSchema['heurefin']->setMessage('required', 'Merci de renseigner l\'heure de fin.');
     $this->validatorSchema['activite']->setMessage('required', 'Merci de renseigner l\'activité.');
     

     
     
     sfValidatorBase::setDefaultMessage('required', 'This field is required.');
    
    $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
	new sfValidatorCallback(array('callback' => array($this, 'checkTempsMinDeReservation'))),
	new sfValidatorCallback(array('callback' => array($this, 'checkPeutReserver'))),
	new sfValidatorCallback(array('callback' => array($this, 'checkCreneauDansLePasse'))),
	new sfValidatorCallback(array('callback' => array($this, 'checkCreneauLibre'))),
	new sfValidatorCallback(array('callback' => array($this, 'checkLimiteMax'))),
	new sfValidatorCallback(array('callback' => array($this, 'checkJourLibre'))),
      	new sfValidatorSchemaCompare('heuredebut', "<", 'heurefin',
	  array(),
	  array('invalid' => 'L\'heure de début doit précéder l\'heure de fin.')
	)
    )));
      
  }
 // Permet de savoir si le temps de réservation est supérieur à une limite minimum de 30mn.
  public function checkTempsMinDeReservation($validator, $values)
  {
    $heureDeb= new DateTime($values['heuredebut']) ;
    $heureFin= new DateTime($values['heurefin']) ;
    $diff = $heureFin->diff($heureDeb);
    
    if ($diff->h==0 && $diff->i==0)
    {
      // créneau trop court
      throw new sfValidatorError($validator, 'Créneau d\'au minimum 30mn');
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
    //var_dump(
    $a=new DateTime($values['date']." ".$values['heuredebut']);
    
    if($a<$d){
	  throw new sfValidatorError($validator, 'Créneau dans le passé, impossible de réserver.');
    }
    
    return $values;

  }
  
  
  
  
  
  // Permet de savoir s'il n'y a pas déjà une réservation à l'heure et à la date demandée.
  public function checkCreneauLibre($validator, $values)
  { 
    
    $q1 = Doctrine_Query::create()
    ->select('count(*)')
    ->from('Reservation r')
    ->where('r.date = ?', $values['date'])
    ->andWhere('r.id_salle = ?', $values['id_salle'])
    ->andWhere('r.heurefin > ?', $values['heuredebut'])
    ->andWhere('r.heurefin <= ?', $values['heurefin'])
    ->andWhere('r.id != ?',$values['id']);
    
    $result1= $q1->fetchOne()["count"];
    
    $q2 = Doctrine_Query::create()
    ->select('count(*)')
    ->from('Reservation r')
    ->where('r.date = ?', $values['date'])
    ->andWhere('r.id_salle = ?', $values['id_salle'])
    ->andWhere('r.heuredebut >= ?', $values['heuredebut'])
    ->andWhere('r.heuredebut < ?', $values['heurefin'])
    ->andWhere('r.id != ?',$values['id']); 
     
    $result2= $q2->fetchOne()["count"];
    
    if($result1!="0" or $result2!="0"){
	  throw new sfValidatorError($validator, 'Ce créneau n\'est pas libre, merci de consulter le calendrier et de choisir un créneau libre.');
    }
    
    return $values;

  }
  
  
  
  
  
  // Permet de voir si la limite de 3h maximum par jour par asso n'est pas atteinte.
  public function checkLimiteMax($validator, $values)
  { 
    if($values['id_asso']!=NULL){
	$q = Doctrine_Query::create()
	->from('Reservation r')
	->where('r.id_asso = ?', $values['id_asso'])
	->andWhere('r.date = ?', $values['date'])
	->andWhere('r.id != ?',$values['id']);;
	
	
	
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
	$m+=$diff->m;
	
	$h+=(int)($m/60);
	$m+=$m%60;
	
	
	if($h>3 or ($h==3 and $m!=0)){
	      throw new sfValidatorError($validator, 'Vous ne pouvez pas réserver plus de 3h dans une même journée pour la même association.');
	}
    }
    else{
	$heureDeb= new DateTime($values['heuredebut']) ;
	$heureFin= new DateTime($values['heurefin']) ;
	$diff = $heureFin->diff($heureDeb);
	//$d=$diff->format('%H');
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
    
    $q = Doctrine_Query::create()
    ->select('count(*)')
    ->from('Reservation r')
    ->where('r.date = ?', $values['date'])
    ->andWhere('r.id_salle = ?', $values['id_salle'])
    ->andWhere('r.allday = ?', 1);

    $result= $q->fetchOne()["count"];
    
    if($result>0){
	  throw new sfValidatorError($validator, 'Impossible de valider, cette salle a été réservée toute la journée.');
    }
    
    return $values;

  }
  
  
  
  
}
