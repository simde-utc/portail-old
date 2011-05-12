<?php

/**
 * Profile form base class.
 *
 * @method Profile getObject() Returns the current form's model object
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'user_id'      => new sfWidgetFormInputText(),
      'nickname'     => new sfWidgetFormInputText(),
      'birthday'     => new sfWidgetFormDate(),
      'sexe'         => new sfWidgetFormInputText(),
      'mobile'       => new sfWidgetFormInputText(),
      'home_place'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('HomePlace'), 'add_empty' => true)),
      'family_place' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FamilyPlace'), 'add_empty' => true)),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'      => new sfValidatorInteger(array('required' => false)),
      'nickname'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'birthday'     => new sfValidatorDate(array('required' => false)),
      'sexe'         => new sfValidatorPass(array('required' => false)),
      'mobile'       => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'home_place'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('HomePlace'), 'required' => false)),
      'family_place' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('FamilyPlace'), 'required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profile';
  }

}
