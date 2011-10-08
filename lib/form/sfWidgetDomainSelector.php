<?php

class sfWidgetDomainSelector extends sfWidgetForm
{
	public function configure($options = array(), $attributes = array ())
	{
		parent::configure($options, $attributes);
	}
 
	public function render($name, $value = null, $attributes = array(), $errors = array())
	{
		$login = new sfWidgetFormInput();
		$login->setAttribute('readonly', 'readonly');
		
		$choices = array(
     '0' => 'etu.utc.fr',
//		 '' => 'hds.utc.fr',
     '1' => 'utc.fr',
     '2' => 'escom.fr',
//     3 => 'tremplin-utc.asso.fr',
//     4 => 'Autre...',
    );

    $domaine = new sfWidgetFormChoice(array('choices' => $choices));

    return $login->render("nickname_email")." @ ".$domaine->render("domain");
		
	}
}