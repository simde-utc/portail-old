<?php

class CreneauDayForm extends sfForm
{
  public function configure()
  {
  	$nbSalles = count(SalleTable::getInstance()->getAllSalles()->execute())*20;
  
    $this->setWidgets(array(
      'date'   => new sfWidgetFormInputText(array(),array('class'=>'date')),
      'salles'     => new sfWidgetFormDoctrineChoice(array('model' => 'Salle','multiple'=>true),array('style'=>'height : '.$nbSalles.'px')),
    ));
 
    $this->setValidators(array(
      'date'   => new sfValidatorString(array('required' => true)),
      'salles'     => new sfValidatorDoctrineChoice(array('model' => 'Salle', 'required' => true)),
    ));
    
    $this->widgetSchema->setNameFormat('CreneauDay[%s]');
    
  }

	public function getModelName()
	{
		return 'CreneauDay';
	}

}

