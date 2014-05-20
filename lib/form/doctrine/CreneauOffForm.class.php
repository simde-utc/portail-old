<?php

/**
 * CreneauOff form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CreneauOffForm extends BaseCreneauOffForm
{
  public function configure()
  {
  		
  		/*
  		Le type date est mieux pour l'utilisateur
  		Sauf que internet explorer et firefox ne le connaisse pas
  		Donc le formulaire est different celon les navigateurs  		
  		*/
  		if (preg_match ("/firefox/i",$_SERVER['HTTP_USER_AGENT']) ||
  			preg_match ("/explorer/i",$_SERVER['HTTP_USER_AGENT']))
  			{
  				$date = $this->widgetSchema['date'] =  new sfWidgetFormDate(
	  			array('format' => '%day%/%month%/%year%')
	  			);
  			}
  			else
  			{
  				$date = $this->widgetSchema['date'] = new sfWidgetFormInput(
  				array('type' => 'date')
  				);
  			}
  
  
  		 

  }
}
