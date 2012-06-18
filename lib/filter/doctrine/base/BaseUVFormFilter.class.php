<?php

/**
 * UV filter form base class.
 *
 * @package    simde
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUVFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'code' => new sfWidgetFormFilterInput(),
      'name' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'code' => new sfValidatorPass(array('required' => false)),
      'name' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('uv_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UV';
  }

  public function getFields()
  {
    return array(
      'id'   => 'Number',
      'code' => 'Text',
      'name' => 'Text',
    );
  }
}
