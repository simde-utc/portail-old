<?php

/**
 * exterieurs actions.
 *
 * @package    simde
 * @subpackage exterieurs
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 **/
class exterieursActions extends sfActions
{
	public function executeIndex(sfWebRequest $request)
	{

	}

	public function executeEdit(sfWebRequest $request)
	{
		$this->tag = "";
		if($tag = $request->getParameter("tag")){
			$this->tag = $tag;
			try {
				$login = "ext_" + $tag;
				$ginger = new \Ginger\Client\GingerClient(sfConfig::get('app_portail_ginger_key'));
				$this->cotisant = $ginger->getUser($login);
				$this->cotisations = $ginger->getCotisations($login);
			}
			catch (\Ginger\Client\ApiException $ex){
				if($ex->getCode() == 404){
				  $this->error = "Utilisateur non trouvé";
				}
				else {
				  $this->error = $ex->getCode()." - ".$ex->getMessage();
				}
			}		
			$this->form = new sfForm();
			if ($this->cotisant) {
				$this->form->setWidgets(array(
			      'prenom' => new sfWidgetFormInputText(array('label' => 'Prénom: ', 'default' => $this->cotisant->prenom)),
			      'nom' => new sfWidgetFormInputText(array('label' => 'Nom: ', 'default' => $this->cotisant->nom)),
			      'mail' => new sfWidgetFormInputText(array('label' => 'Mail (laisser vide si inconnu): ', 'default' => $this->cotisant->mail)),
			      'is_adulte' => new sfWidgetFormChoice(array('label' => 'Adulte ? ', 'choices' => array('Non', 'Oui'), 'default' => $cotisant->is_adulte))
			  	));
			}
			else {
				$this->form->setWidgets(array(
			      'prenom' => new sfWidgetFormInputText(array('label' => 'Prénom: ')),
			      'nom' => new sfWidgetFormInputText(array('label' => 'Nom: ')),
			      'mail' => new sfWidgetFormInputText(array('label' => 'Mail (laisser identique si inconnu): ', 'default' => 'bde-badge'.$tag.'@assos.utc.fr')),
			      'is_adulte' => new sfWidgetFormChoice(array('label' => 'Adulte ? ', 'choices' => array('Non', 'Oui')))
			  	));;
			}
		}
	}
}