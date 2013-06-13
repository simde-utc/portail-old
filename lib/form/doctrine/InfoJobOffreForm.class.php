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
      $hidden_fields = array(
        'emailkey',
        'user_id',
        'created_at',
        'updated_at',
        'archivage_date',
        'validation_date',
        'validationkey'
      );
      foreach($hidden_fields as $hidden_field) {
        $this->widgetSchema[$hidden_field]= new sfWidgetFormInputHidden();
      }
      $this->widgetSchema['expiration_date'] = new sfWidgetFormJQueryDate();
      $this->widgetSchema->setLabels(array(
        'categorie_id' => 'Type d\'emploi',
        'disponibilite_list' => 'Disponibilité demandée',
        'texte' => 'Description de l\'emploi et modalités',
        'remuneration' => 'Rémunération',
        'email' => 'Adresse email',
        'telephone' => 'Téléphone',
      ));
  }
}
