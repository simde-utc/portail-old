<?php

/**
 * InfoJobSignalement form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InfoJobSignalementForm extends BaseInfoJobSignalementForm
{
  public function configure()
  {
    $this->widgetSchema['commentaire'] = new  sfWidgetFormTextarea();
	  $hidden_fields = array(
      'offre_id',
    );
		foreach($hidden_fields as $hidden_field) {
      $this->widgetSchema[$hidden_field]= new sfWidgetFormInputHidden();
    }
    $unsetted_fields = array(
      'created_at',
      'updated_at',
      'archivage_date'
    );
    foreach($unsetted_fields as $unsetted_field) {
      unset($this->widgetSchema[$unsetted_field]);
    	unset($this->validatorSchema[$unsetted_field]);
    }
  }
}
