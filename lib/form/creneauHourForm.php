<?php

class CreneauHourForm extends sfForm
{
  public function configure()
  {
    $nbSalles = count(SalleTable::getInstance()->getAllSalles()->execute())*20;
  
    $this->setWidgets(array(
      'date'   => new sfWidgetFormInputText(array(),array('class'=>'date')),
      'debut' => new sfWidgetFormTime(array(),array('style'=>'width : 100px')),
      'fin' => new sfWidgetFormTime(array(),array('style'=>'width : 100px')),
      'salles'     => new sfWidgetFormDoctrineChoice(array('model' => 'salle', 'multiple'=>true),array('style'=>'height : '.$nbSalles.'px')),
    ));
 
    $this->setValidators(array(
      'date'   => new sfValidatorString(array('required' => true)),
      'debut' => new sfValidatorTime(array('required' => true)),
      'fin' => new sfValidatorTime(array('required' => true)),
      'salles'     => new sfValidatorDoctrineChoice(array('model' => 'salle', 'required' => true)),
    ));
    
    $hours = [sprintf("%02d",8),sprintf("%02d",9),10,11,12,13,14,15,16,17,18,19,20,21,22,23];
    $minutes = [sprintf("%02d",0),30];
    
    $this->getWidget('debut')->addOption('minutes', array_combine($minutes, $minutes));
    $this->getWidget('fin')->addOption('minutes', array_combine($minutes, $minutes));
    
    $this->getWidget('debut')->addOption('hours', array_combine($hours, $hours));
    $this->getWidget('fin')->addOption('hours', array_combine($hours, $hours));
  
  
    $this->widgetSchema->setNameFormat('CreneauHour[%s]');
  
  }

  public function getModelName()
  {
    return 'CreneauHour';
  }

}

