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
  { 	unset($this['created_at'], $this['updated_at'], $this['expiration_date'], $this['archivage_date'],$this['offre_id']);
  		
  		 $this->widgetSchema['commentaire'] = new  sfWidgetFormTextarea();
  }
}
