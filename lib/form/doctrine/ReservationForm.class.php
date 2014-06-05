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
  
     $query = $this->getOption('query');
    
     $this->widgetSchema['id_user_valid'] = new sfWidgetFormInputHidden();
     $this->widgetSchema['id_salle'] = new sfWidgetFormInputHidden();
     $this->widgetSchema['id_user_reserve'] = new sfWidgetFormInputHidden();
     $this->widgetSchema['estvalide'] = new sfWidgetFormInputHidden();
     $this->widgetSchema['date'] = new sfWidgetFormDate(array('format'=>'%day%/%month%/%year%','can_be_empty'=>false));	
     $this->widgetSchema['heuredebut'] = new sfWidgetFormTime(array('can_be_empty'=>false));	
     
     $this->getWidget('id_asso')->setOption('add_empty',true);
    
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
     
     //$this->WidgetValidator['date']= new sfValidatorDate(array('required'=>'Ce champs est obligatoire'));
     //$this->WidgetValidator['heuredebut']= new sfValidatorTime(array('required'=>'Ce champs est obligatoire'));
     //$this->WidgetValidator['heurefin']= new sfValidatorTime(array('required'=>'Ce champs est obligatoire'));
     $this->validatorSchema['heurefin']->setMessage('required', 'Merci de renseigner l\'heure de fin.');
     $this->validatorSchema['activite']->setMessage('required', 'Merci de renseigner l\'activité.');
     
     
     sfValidatorBase::setDefaultMessage('required', 'This field is required.');
     
     /*$this->validatorSchema->setPostValidator(
	new sfValidatorSchemaCompare('heuredebut', "<", 'heurefin',
	  array(),
	  array('invalid' => 'L\'heure de début doit précéder l\'heure de fin.')
	),
	new sfValidatorCallback(array('callback' => array($this, 'checkTempsDeReservation')))
      );*/
      
    /*$this->validatorSchema->setPostValidator(array(
      new sfValidatorCallback(array('callback' => array($this, 'checkTempsDeReservation')))
    ));*/
    
    $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
	new sfValidatorCallback(array('callback' => array($this, 'checkTempsDeReservation'))),
	new sfValidatorCallback(array('callback' => array($this, 'checkPeutReserver'))),
      	new sfValidatorSchemaCompare('heuredebut', "<", 'heurefin',
	  array(),
	  array('invalid' => 'L\'heure de début doit précéder l\'heure de fin.')
	)
    )));
      
    
     //$this->widgetSchema->setHelp('date', 'Date de debut, creneau 1, 2 ou 3h max');
     
     
     /*$this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'checkTempsDeReservation')))
    );*/
  }
 
  public function checkTempsDeReservation($validator, $values)
  {
   //Validate form here
   //Access form items using  $values['FORMNAME'];
   //$error = new sfValidatorError($validator, 'A Error Message.');
   //$es = new sfValidatorErrorSchema($validator, array('FORMITEM' => $error);
   //throw $es;
    
    $heureDeb= new DateTime($values['heuredebut']) ;
    $heureFin= new DateTime($values['heurefin']) ;
    $diff = $heureFin->diff($heureDeb);
    $d=$diff->format('%H');
    var_dump($diff->m);
    if ($diff->h>3 or ($diff->h==3 and $diff->m!=0))
    {
      // créneau trop long
      throw new sfValidatorError($validator, 'Créneau trop large, 3 heures max.');
    }
    
    if ($diff->h==0 and $diff->m==0)
    {
      // créneau trop long
      throw new sfValidatorError($validator, 'Créneau d\'au minimum 30mn');
    }
 
    // créneau correct, on retourne les données nettoyées
    return $values;
  }
  
  public function checkPeutReserver($validator, $values)
  { 
    $jourDeb= new DateTime();
    var_dump($values['date']);
    /*$jourDeb->setDate($values['date']);
    $jourDeb->setTime($values['heuredebut']);
    $heureFin= new DateTime() ;
    $diff = $heureFin->diff($heureDeb);
    $d=$diff->format('%H');*/
    
    if ($diff->h>3 or ($diff->h==3 and $diff->m!=0))
    {
      // créneau trop long
      throw new sfValidatorError($validator, 'Créneau trop large, 3 heures max.');
    }
    
    if ($diff->h==0 and $diff->m==0)
    {
      // créneau trop long
      throw new sfValidatorError($validator, 'Créneau d\'au minimum 30mn');
    }
 
    // créneau correct, on retourne les données nettoyées
    return $values;
  }

}
