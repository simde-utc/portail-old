<?php

/**
 * SalleCreneauOff form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SalleCreneauOffForm extends BaseSalleCreneauOffForm
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
  				$this->widgetSchema['creneauoff'] =  new sfWidgetFormDate(
	  			array('format' => '%day%/%month%/%year%')
	  			);
  			}
  			else
  			{
  				$this->widgetSchema['creneauoff'] = new sfWidgetFormInput(
  				array('type' => 'date')
  				);
  			}
  			
  			$this->widgetSchema['creneauoff']->setLabel('Date');
  		
  			
  			$s = $this->widgetSchema['salle'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Salle'), 'add_empty' => false, 'multiple' => true));
  
  			$t = count($s->getChoices()) * 20;
  
  			$this->widgetSchema['salle']->setAttribute('style','height: '.$t.'px');
  
  			$this->widgetSchema->setNameFormat('creneau_off[%s]');
  
  }
}
