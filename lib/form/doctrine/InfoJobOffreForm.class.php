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
        'archivage_date'
      );
      foreach($hidden_fields as $hidden_field) {
        $this->widgetSchema[$hidden_field]= new sfWidgetFormInputHidden();
      }
  }
}
