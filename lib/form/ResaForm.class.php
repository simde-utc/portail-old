<?php
class ResaForm extends sfForm
{ 
  protected static $typesActivite = array('reunion', 'blabla','autre');
      
  public function configure()
  {

    $this->setWidgets(array(
      'date'           => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')),
      'heuredebut'     => new sfWidgetFormTime(),
      'heurefin'       => new sfWidgetFormTime(),
      'id_asso'   => new sfWidgetFormDoctrineChoiceWithParams(array('model' => 'asso', 'table_method' => array('method' => 'getMyAssosName' , 'parameters' => array($this->getOption('UserID'),$this->getOption('idSalle'))))),
      'nbPers'     => new sfWidgetFormInputText(),
      'activite'  => new sfWidgetFormChoice(array('choices'  => self::$typesActivite)),
      'message'   => new sfWidgetFormTextarea(),
      'id_salle'  => new sfWidgetFormInputHidden(),

    ));
    
    $years = range(date('Y'), date('Y') + 2);
    $this->getWidget('date')->addOption('years', array_combine($years, $years));
    $minutes = [sprintf("%02d",0),30];
    
    $hours = [sprintf("%02d",8),sprintf("%02d",9),10,11,12,13,14,15,16,17,18,19,20,21,22,23];
    $this->getWidget('heuredebut')->addOption('minutes', array_combine($minutes, $minutes));
    $this->getWidget('heuredebut')->addOption('hours', array_combine($hours, $hours));
    $this->getWidget('heuredebut')->addOption('can_be_empty', false);
    
    $this->getWidget('heurefin')->addOption('minutes', array_combine($minutes, $minutes));
    $this->getWidget('heurefin')->addOption('hours', array_combine($hours, $hours));

    $this->getWidget('id_salle')->setDefault($this->getOption('idSalle'));  
    
    $this->setValidators(array(
      'date'      => new sfValidatorDate(array('required' => true)),
      'heurefin'      => new sfValidatorDate(array('required' => true)),
    ));
    
    $this->validatorSchema->setPostValidator(
      new sfValidatorSchemaCompare('heuredebut', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'heurefin',
        array('throw_global_error' => true),
        array('invalid' => 'L\'heure début ("%left_field%") doit être avant l\'heure de fin ("%right_field%")')
      )
    );

    //$this->widgetSchema->setNameFormat('resa-form[%s]'); // pour les id et les class pour modif CSS
  }
}
