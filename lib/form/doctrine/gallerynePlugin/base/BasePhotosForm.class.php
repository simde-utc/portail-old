<?php

/**
 * Photos form base class.
 *
 * @method Photos getObject() Returns the current form's model object
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePhotosForm extends GalleryneFileForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['order_photo'] = new sfWidgetFormInputText();
    $this->validatorSchema['order_photo'] = new sfValidatorInteger(array('required' => false));

    $this->widgetSchema   ['gallery_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gallery'), 'add_empty' => true));
    $this->validatorSchema['gallery_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gallery'), 'required' => false));

    $this->widgetSchema->setNameFormat('photos[%s]');
  }

  public function getModelName()
  {
    return 'Photos';
  }

}
