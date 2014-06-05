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
      $query = AssoTable::getInstance()->getMyAssosName($this->getOption('UserID'),$this->getOption('idSalle'));
    
     $this->widgetSchema['id_user_valid'] = new sfWidgetFormInputHidden();
     $this->widgetSchema['id_salle'] = new sfWidgetFormInputHidden();
     $this->widgetSchema['id_user_reserve'] = new sfWidgetFormInputHidden();
     $this->widgetSchema['estvalide'] = new sfWidgetFormInputHidden();
     $this->widgetSchema['date'] = new sfWidgetFormDate(array('format'=>'%day%/%month%/%year%','can_be_empty'=>false));	
     $this->widgetSchema['heuredebut'] = new sfWidgetFormTime(array('can_be_empty'=>false));
     
     
     $types = array(
	  'reunion' => 'Réunion',
	  'logistique' => 'Autre',
     );
     
     $this->widgetSchema['activite'] = new sfWidgetFormChoice(array(
	  'choices'  => $types,
      ));
      
     
    
     $this->widgetSchema['id_asso'] = new sfWidgetFormDoctrineChoice(array(
		'model' => $this->getRelatedModelName('Asso'), 
		'query' => $query 
     ));

     $years = range(date('Y'), date('Y') + 2);
     $this->getWidget('date')->addOption('years', array_combine($years, $years));
     $minutes = [sprintf("%02d",0),30];
		
     $hours = [sprintf("%02d",8),sprintf("%02d",9),10,11,12,13,14,15,16,17,18,19,20,21,22,23];
     $this->getWidget('heuredebut')->addOption('minutes', array_combine($minutes, $minutes));
     $this->getWidget('heuredebut')->addOption('hours', array_combine(range(8,23),$hours));
     $this->getWidget('heurefin')->addOption('minutes', array_combine($minutes, $minutes));
     $this->getWidget('heurefin')->addOption('hours', array_combine(range(8,23), $hours));
     
     $this->getWidget('date')->setLabel('Date:');
     $this->getWidget('heuredebut')->setLabel('Créneau:');
     $this->getWidget('activite')->setLabel('Activité:');
     $this->getWidget('id_asso')->setLabel('Association:');
     
     $this->validatorSchema['heurefin']->setMessage('required', 'Merci de renseigner l\'heure de fin.');
     $this->validatorSchema['activite']->setMessage('required', 'Merci de renseigner l\'activité.');
     
     
     sfValidatorBase::setDefaultMessage('required', 'This field is required.');
    
    $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
	new sfValidatorCallback(array('callback' => array($this, 'checkTempsDeReservation'))),
	new sfValidatorCallback(array('callback' => array($this, 'checkPeutReserver'))),
	new sfValidatorCallback(array('callback' => array($this, 'checkCreneauDansLePasse'))),
	new sfValidatorCallback(array('callback' => array($this, 'checkCreneauLibre'))),
      	new sfValidatorSchemaCompare('heuredebut', "<", 'heurefin',
	  array(),
	  array('invalid' => 'L\'heure de début doit précéder l\'heure de fin.')
	)
    )));
      
  }
 
  public function checkTempsDeReservation($validator, $values)
  {
   //Validate form here
   //Access form items using  $values['FORMNAME'];
   //$error = new sfValidatorError($validator, 'A Error Message.');
   //$es = new sfValidatorErrorSchema($validator, array('FORMITEM' => $error);
   //throw $es;
    var_dump(date_default_timezone_get());
    var_dump(new DateTime());
    $heureDeb= new DateTime($values['heuredebut']) ;
    $heureFin= new DateTime($values['heurefin']) ;
    $diff = $heureFin->diff($heureDeb);
    //$d=$diff->format('%H');
    if ($diff->h>3 or ($diff->h==3 and $diff->i!=0))
    {
      // créneau trop long
      throw new sfValidatorError($validator, 'Créneau trop large, 3 heures max.');
    }
    
    if ($diff->h==0 && $diff->i==0)
    {
      // créneau trop court
      throw new sfValidatorError($validator, 'Créneau d\'au minimum 30mn');
    }
 
    // créneau correct, on retourne les données nettoyées
    return $values;
  }
  
  
  public function checkPeutReserver($validator, $values)
  { 
    //date_default_timezone_set(NULL);
    $d= new DateTime();
    $a=new DateTime($values['date']." ".$values['heuredebut']);
    $diff = $a->diff($d);
    
    if($diff->y==0 and $diff->m==0 and $diff->d==0 and $diff->h==0 and $diff->i<59){
	  throw new sfValidatorError($validator, 'Vous devez effectuer la réservation au moins une heure avant le début du créneau.');
    }
    
    return $values;

  }

  public function checkCreneauDansLePasse($validator, $values)
  { 
    date_default_timezone_set('Europe/Paris');
    $d= new DateTime();
    $a=new DateTime($values['date']." ".$values['heuredebut']);
    var_dump($a<$d);
    
    if($a<$d){
	  throw new sfValidatorError($validator, 'Créneau dans le passé, impossible de réserver.');
    }
    
    return $values;

  }
  
  public function checkCreneauLibre($validator, $values)
  { 

    $q1 = Doctrine_Query::create()
    ->select('count(*)')
    ->from('Reservation r')
    ->where('r.date = ?', $values['date'])
    ->andWhere('r.heurefin > ?', $values['heuredebut'])
    ->andWhere('r.heurefin <= ?', $values['heurefin']);
    
    $result1= $q1->fetchOne()["count"];
    
    $q2 = Doctrine_Query::create()
    ->select('count(*)')
    ->from('Reservation r')
    ->where('r.date = ?', $values['date'])
    ->andWhere('r.heuredebut >= ?', $values['heuredebut'])
    ->andWhere('r.heuredebut < ?', $values['heurefin']);
     
    $result2= $q2->fetchOne()["count"];
    var_dump($result1);
    var_dump($result2);
   
    
    if($result1!="0" or $result2!="0"){
	  throw new sfValidatorError($validator, 'Ce créneau n\'est pas libre, merci de consulter le calendrier et de choisir un créneua libre.');
    }
    
    return $values;

  }
  
  
  
  
}
