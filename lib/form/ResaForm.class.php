<?php
class ResaForm extends sfForm
{ 
	public function configure()
	{
		$this->setWidgets(array(
			'date'         => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')), // voir pour commencer à la bonne année
			'heuredebut'   => new sfWidgetFormTime(),
			'heurefin'     => new sfWidgetFormTime(),
			'id_asso' 		=> new sfWidgetFormDoctrineChoiceWithParams(array('model' => 'asso', 'table_method' => array('method' => 'getMyAssosName' , 'parameters' => array($this->getOption('UserID'),$this->getOption('idSalle'))))),
			'nbPers'   		=> new sfWidgetFormInputText(),
			'message' 		=> new sfWidgetFormTextarea(),
			'id_salle'		=> new sfWidgetFormInputHidden(),

		));

		$this->getWidget('id_salle')->setDefault($this->getOption('idSalle'));		

		$this->widgetSchema->setNameFormat('resa-form[%s]'); // pour les id et les class pour modif CSS
	}
}
