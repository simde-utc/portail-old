<?php

/**
 * AssoMember form base class.
 *
 * @method AssoMember getObject() Returns the current form's model object
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAssoMemberForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'user_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'asso_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Asso'), 'add_empty' => false)),
      'role_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Role'), 'add_empty' => false)),
      'semestre_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Semestre'), 'add_empty' => false)),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'asso_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Asso'))),
      'role_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Role'))),
      'semestre_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Semestre'))),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('asso_member[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AssoMember';
  }

}
