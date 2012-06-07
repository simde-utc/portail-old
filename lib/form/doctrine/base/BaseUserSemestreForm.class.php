<?php

/**
 * UserSemestre form base class.
 *
 * @method UserSemestre getObject() Returns the current form's model object
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUserSemestreForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'user_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profile'), 'add_empty' => true)),
      'branche_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Branche'), 'add_empty' => true)),
      'num'         => new sfWidgetFormInputText(),
      'abroad'      => new sfWidgetFormInputText(),
      'semestre_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Semestre'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profile'), 'required' => false)),
      'branche_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Branche'), 'required' => false)),
      'num'         => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'abroad'      => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'semestre_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Semestre'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_semestre[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserSemestre';
  }

}
