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
    $unsetted_fields = array(
      'user_id',
      'created_at',
      'updated_at',
      'emailkey',
      'validationkey',
      'archivage_date',
      'archivage_date',
      'validation_date'
    );
    foreach($unsetted_fields as $unsetted_field) {
      unset($this->widgetSchema[$unsetted_field]);
    	unset($this->validatorSchema[$unsetted_field]);
    }
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
