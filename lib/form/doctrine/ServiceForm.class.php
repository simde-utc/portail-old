<?php

/**
 * Service form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ServiceForm extends BaseServiceForm
{
  public function configure()
  {
    sfProjectConfiguration::getActive()->loadHelpers(array('Asset', 'Thumb'));

    unset($this['created_at'], $this['updated_at']);

    $this->widgetSchema['logo'] = new sfWidgetFormInputFileEditable(array(
      'file_src' => doThumb($this->getObject()->getLogo(), 'services', array('width'=>150, 'height'=>150), 'scale'),
      'is_image' => true,
      'edit_mode' => (!$this->isNew() && $this->getObject()->getLogo()),
      'with_delete' => true,
      'delete_label' => "Supprimer ce logo",
    ));

    $this->validatorSchema['logo'] = new sfValidatorFileImage(array(
      'required' => false,
      'path' => sfConfig::get('sf_upload_dir').'/services/source',
      'mime_types' => 'web_images',
      'max_width' => 1000,
      'max_height' => 1000
    ));

    $this->validatorSchema['logo_delete'] = new sfValidatorBoolean();

    $this->widgetSchema['nom']->setAttribute('size','50');
    $this->widgetSchema['resume']->setAttribute('size','50');
    $this->widgetSchema['url']->setAttribute('size','50');
  }
}
