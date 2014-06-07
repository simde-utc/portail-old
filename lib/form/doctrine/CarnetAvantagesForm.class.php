<?php

/**
 * CarnetAvantages form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CarnetAvantagesForm extends BaseCarnetAvantagesForm
{
  public function configure()
  {

	sfProjectConfiguration::getActive()->loadHelpers(array('Asset', 'Thumb'));

    unset($this['created_at'],$this['updated_at']);

    $this->widgetSchema['logo'] = new sfWidgetFormInputFileEditable(array(
      'file_src' => doThumb($this->getObject()->getLogo(), 'carnetavantages', array('width'=>150, 'height'=>150), 'scale'),
      'is_image' => true,
      'edit_mode' => (!$this->isNew() && $this->getObject()->getLogo()),
      'with_delete' => true,
      'delete_label' => "Supprimer ce logo",
    ));

    $this->validatorSchema['logo'] = new sfValidatorFileImage(array(
      'required' => false,
      'path' => sfConfig::get('sf_upload_dir').'/carnetavantages/source',
      'mime_types' => 'web_images',
      'max_width' => 1000,
      'max_height' => 1000
    ));

    $this->validatorSchema['logo_delete'] = new sfValidatorBoolean();
  }

}
