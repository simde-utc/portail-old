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
      'id'                 => new sfWidgetFormInputHidden(),
      'user_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'domain'             => new sfWidgetFormInputText(),
      'nickname'           => new sfWidgetFormInputText(),
      'birthday'           => new sfWidgetFormDate(),
      'sexe'               => new sfWidgetFormInputText(),
      'mobile'             => new sfWidgetFormInputText(),
      'home_place'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('HomePlace'), 'add_empty' => true)),
      'family_place'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FamilyPlace'), 'add_empty' => true)),
      'branche_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Branche'), 'add_empty' => true)),
      'filiere_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Filiere'), 'add_empty' => true)),
      'semestre'           => new sfWidgetFormInputText(),
      'other_email'        => new sfWidgetFormTextarea(),
      'photo'              => new sfWidgetFormTextarea(),
      'weekmail'           => new sfWidgetFormInputCheckbox(),
      'autorisation_photo' => new sfWidgetFormInputCheckbox(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'domain'             => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'nickname'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'birthday'           => new sfValidatorDate(array('required' => false)),
      'sexe'               => new sfValidatorPass(array('required' => false)),
      'mobile'             => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'home_place'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('HomePlace'), 'required' => false)),
      'family_place'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('FamilyPlace'), 'required' => false)),
      'branche_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Branche'), 'required' => false)),
      'filiere_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Filiere'), 'required' => false)),
      'semestre'           => new sfValidatorInteger(array('required' => false)),
      'other_email'        => new sfValidatorString(array('required' => false)),
      'photo'              => new sfValidatorString(array('required' => false)),
      'weekmail'           => new sfValidatorBoolean(array('required' => false)),
      'autorisation_photo' => new sfValidatorBoolean(array('required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
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
