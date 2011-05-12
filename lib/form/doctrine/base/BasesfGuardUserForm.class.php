<?php

/**
 * sfGuardUser form base class.
 *
 * @method sfGuardUser getObject() Returns the current form's model object
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'first_name'     => new sfWidgetFormInputText(),
      'last_name'      => new sfWidgetFormInputText(),
      'email_adress'   => new sfWidgetFormInputText(),
      'username'       => new sfWidgetFormInputText(),
      'algorithm'      => new sfWidgetFormInputText(),
      'salt'           => new sfWidgetFormInputText(),
      'password'       => new sfWidgetFormInputText(),
      'domain'         => new sfWidgetFormInputText(),
      'is_active'      => new sfWidgetFormInputCheckbox(),
      'is_super_admin' => new sfWidgetFormInputCheckbox(),
      'last_login'     => new sfWidgetFormDateTime(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'first_name'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'last_name'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email_adress'   => new sfValidatorString(array('max_length' => 255)),
      'username'       => new sfValidatorString(array('max_length' => 128)),
      'algorithm'      => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'salt'           => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'password'       => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'domain'         => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'is_active'      => new sfValidatorBoolean(array('required' => false)),
      'is_super_admin' => new sfValidatorBoolean(array('required' => false)),
      'last_login'     => new sfValidatorDateTime(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('email_adress'))),
        new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('username'))),
        new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('username', 'domain'))),
      ))
    );

    $this->widgetSchema->setNameFormat('sf_guard_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUser';
  }

}
