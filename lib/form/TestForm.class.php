<?php
class TestForm extends sfForm
{ 
	public function configure()
	{
		$this->setWidgets(array(
			'date'            => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')), // voir pour commencer à la bonne année
			'heuredebut'      => new sfWidgetFormTime(),
			'heurefin'        => new sfWidgetFormTime(),
			'id_asso' => new sfWidgetFormDoctrineChoice(array('model' => 'asso', 'table_method' => 'getAssosList')),
			'nbPers'   => new sfWidgetFormInputText(),
			'message' => new sfWidgetFormTextarea(),

		));

		$this->widgetSchema->setLabels(array(
		  'id_asso'    => 'Association:',
		  'heuredebut'    => 'De',
		  'heurefin'   => 'à',
		  'nbPers' => 'Nombre de personnes:',
		  'message' => 'Commentaires:',
		));
		
		
		$this->setValidators(array(
			'name'    => new sfValidatorString(),
		));

		$this->widgetSchema->setNameFormat('test-form[%s]');
	}
}
