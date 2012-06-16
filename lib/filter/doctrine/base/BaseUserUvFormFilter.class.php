<?php

/**
 * UserUv filter form base class.
 *
 * @package    simde
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUserUvFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'uv_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Uv'), 'add_empty' => true)),
      'user_semestre_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserSemestre'), 'add_empty' => true)),
      'note'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'uv_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Uv'), 'column' => 'id')),
      'user_semestre_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserSemestre'), 'column' => 'id')),
      'note'             => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_uv_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserUv';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'uv_id'            => 'ForeignKey',
      'user_semestre_id' => 'ForeignKey',
      'note'             => 'Text',
    );
  }
}
