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
  const LOGIN_PATTERN = "ext_";
  public function executeIndex(sfWebRequest $request)
  {

  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($request->getParameter("tag") != "");
    $this->tag = $request->getParameter("tag");
    try {
      $login = self::LOGIN_PATTERN . $this->tag;
      $ginger = new \Ginger\Client\GingerClient(sfConfig::get('app_portail_ginger_key'));
      $this->cotisant = $ginger->getUser($login);
      $this->cotisations = $ginger->getCotisations($login);
    }
    catch (\Ginger\Client\ApiException $ex){
      if($ex->getCode() == 404){
        $this->error = "Utilisateur non trouvé, contacter le SiMDE (simde@assos.utc.fr) pour régler le problème!";
      }
      else {
        $this->error = $ex->getCode()." - ".$ex->getMessage();
      }
    }       
    $this->editForm = new sfForm();
    if ($this->cotisant) {
        $this->editForm->setWidgets(array(
          'prenom' => new sfWidgetFormInputText(array('label' => 'Prénom: ', 'default' => $this->cotisant->prenom)),
          'nom' => new sfWidgetFormInputText(array('label' => 'Nom: ', 'default' => $this->cotisant->nom)),
          'mail' => new sfWidgetFormInputText(array('label' => 'Mail (laisser vide si inconnu): ', 'default' => $this->cotisant->mail)),
          'is_adulte' => new sfWidgetFormChoice(array('label' => 'Adulte ? ', 'choices' => array('Non', 'Oui'), 'default' => $this->cotisant->is_adulte))
        ));
      $this->editForm->setValidators(array(
        'prenom' => new sfValidatorString(),
        'nom' => new sfValidatorString(),
        'is_adulte' => new sfValidatorChoice(array('choices' => array('0', '1'))),
        'mail' => new sfValidatorEmail()));


      // les cotisations s'arrêtent le 31 aout
      $debut = date('Y-m-d');
      $yearend = date("Y");
      if(date("m") > 8){
        $yearend++;
      }
      $fin = "$yearend-08-31";
      $this->cotizForm = new sfForm();
      $this->cotizForm->setWidgets(array(
        'montant' => new sfWidgetFormInputText(array(
            'label' => 'Montant de la cotisation: ',
            'default' => 20)),
        'debut_cotiz' => new sfWidgetFormDate(array(
            'can_be_empty' => false,
            'label' => 'Date de début de cotisation (format 2015/05/31): ',
            'format' => '%year%-%month%-%day%',
            'default' => $debut)),      
        'fin_cotiz' => new sfWidgetFormDate(array(
            'can_be_empty' => false,
            'label' => 'Date de fin de cotisation (format 2015/05/31): ',
            'format' => '%year%-%month%-%day%',
            'default' => $fin))));
      $this->cotizForm->setValidators(array(
        'montant' => new sfValidatorInteger(array('min' => 0)),
        'fin_cotiz' => new sfValidatorDate(array('max' => $fin), array('invalid' => 'La date de fin doit être inférieure au 31 août de l\'année suivante')),
        'debut_cotiz' => new sfValidatorDate(array('min' => $debut, 'max' => $fin))));

      $this->cotizForm->getValidatorSchema()->setPostValidator(
        new sfValidatorSchemaCompare('debut_cotiz', sfValidatorSchemaCompare::LESS_THAN, 'fin_cotiz',
            array('throw_global_error' => true),
            array('invalid' => 'La date de début ("%left_field%") doit être strictement inférieure à la date de fin ("%right_field%")')
        )
      );
      $this->cotizForm->getWidgetSchema()->setNameFormat('cotiz[%s]');
      $this->editForm->getWidgetSchema()->setNameFormat('edit[%s]');
      $this->processForm($request, $this->editForm, $this->cotizForm);
    }
  }
  public function processForm(sfWebRequest $request, sfForm $editForm, sfForm $cotizForm)
  {
    if($request->isMethod('POST'))
    {
      if($request->hasParameter('btnEdit'))
      {
          $this->editForm->bind($request->getParameter($editForm->getName()));
          if ($this->editForm->isValid())
          {
            $values = $this->editForm->getValues();
            try {
              $login = self::LOGIN_PATTERN . $this->tag;
              $ginger = new \Ginger\Client\GingerClient(sfConfig::get('app_portail_ginger_key'));
              $ginger->setPersonne($login, $values["nom"], $values["prenom"], $values["mail"], $values["is_adulte"]);
            }
            catch (\Ginger\Client\ApiException $ex) {
              if ($ex->getCode() == 404) {
                $this->error = "Utilisateur non trouve !";
              }
              else {
                $this->error = $ex->getCode(). " - " . $ex->getMessage();
              }
            }
          }
      }
      else if ($request->hasParameter('btnCotiser'))
      {
        $this->cotizForm->bind($request->getParameter($cotizForm->getName()));
        if ($this->cotizForm->isValid())
        {
          $values = $this->cotizForm->getValues();
          try {
            $login = self::LOGIN_PATTERN . $this->tag;
            $ginger = new \Ginger\Client\GingerClient(sfConfig::get('app_portail_ginger_key'));
            $ginger->addCotisation($login, $values["debut_cotiz"], $values["fin_cotiz"], $values["montant"]);
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
        }
      }
    }
  }
}