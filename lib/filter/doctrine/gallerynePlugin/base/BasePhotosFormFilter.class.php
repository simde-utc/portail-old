<?php

/**
 * Photos filter form base class.
 *
 * @package    simde
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePhotosFormFilter extends GalleryneFileFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['order_photo'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['order_photo'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema   ['gallery_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gallery'), 'add_empty' => true));
    $this->validatorSchema['gallery_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Gallery'), 'column' => 'id'));

    $this->widgetSchema->setNameFormat('photos_filters[%s]');
  }

  public function getModelName()
  {
    return 'Photos';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'order_photo' => 'Number',
      'gallery_id' => 'ForeignKey',
    ));
  }
}
