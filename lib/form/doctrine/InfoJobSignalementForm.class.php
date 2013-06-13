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
        'archivage_date'
      );
      
      	unset($this->widgetSchema['created_at']);
      	unset($this->validatorSchema['created_at']);
      	unset($this->widgetSchema['updated_at']);
      	unset($this->validatorSchema['updated_at']);
  		foreach($hidden_fields as $hidden_field) {
        $this->widgetSchema[$hidden_field]= new sfWidgetFormInputHidden();
      }
  }
}
