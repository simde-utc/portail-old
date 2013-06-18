<?php

/**
 * InfoJobOffre form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InfoJobOffreForm extends BaseInfoJobOffreForm
{
  public function configure()
  {
    // Cacher ou supprimer certains champs.
    $hidden_fields = array(
      'user_id',
      'archivage_date',
      'validation_date',
    );
    foreach($hidden_fields as $hidden_field) {
      $this->widgetSchema[$hidden_field]= new sfWidgetFormInputHidden();
    }
    unset($this->widgetSchema['created_at']);
  	unset($this->validatorSchema['created_at']);
  	unset($this->widgetSchema['updated_at']);
  	unset($this->validatorSchema['updated_at']);
    unset($this->widgetSchema['emailkey']);
  	unset($this->validatorSchema['emailkey']);
  	unset($this->widgetSchema['validationkey']);
  	unset($this->validatorSchema['validationkey']);
    // Configurer le formulaire.
    $this->widgetSchema['expiration_date'] = new sfWidgetFormJQueryDate();
    $this->widgetSchema->setLabels(array(
      'categorie_id' => 'Type d\'emploi',
      'disponibilites_list' => 'Disponibilité requise',
      'texte' => 'Description de l\'emploi et modalités',
      'remuneration' => 'Rémunération',
      'email' => 'Adresse email',
      'telephone' => 'Téléphone',
      'expiration_date' => 'Date d\'expiration (facultatif)',
    ));
  }
}
