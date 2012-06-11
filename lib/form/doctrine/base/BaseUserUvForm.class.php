<?php

/**
 * UserUv form base class.
 *
 * @method UserUv getObject() Returns the current form's model object
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUserUvForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'uv_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Uv'), 'add_empty' => true)),
      'user_semestre_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserSemestre'), 'add_empty' => true)),
      'note'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'uv_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Uv'), 'required' => false)),
      'user_semestre_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserSemestre'), 'required' => false)),
      'note'             => new sfValidatorString(array('max_length' => 2, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_uv[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserUv';
  }

}
