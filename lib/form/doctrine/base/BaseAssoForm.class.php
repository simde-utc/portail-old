<?php

/**
 * Asso form base class.
 *
 * @method Asso getObject() Returns the current form's model object
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAssoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'login'       => new sfWidgetFormInputText(),
      'pole_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pole'), 'add_empty' => true)),
      'type_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Type'), 'add_empty' => true)),
      'summary'     => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
      'logo'        => new sfWidgetFormInputText(),
      'active'      => new sfWidgetFormInputCheckbox(),
      'passation'   => new sfWidgetFormInputCheckbox(),
      'salle'       => new sfWidgetFormInputText(),
      'phone'       => new sfWidgetFormInputText(),
      'facebook'    => new sfWidgetFormInputText(),
      'joignable'   => new sfWidgetFormInputCheckbox(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 50)),
      'login'       => new sfValidatorString(array('max_length' => 32)),
      'pole_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pole'), 'required' => false)),
      'type_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Type'), 'required' => false)),
      'summary'     => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'description' => new sfValidatorString(array('required' => false)),
      'logo'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'active'      => new sfValidatorBoolean(array('required' => false)),
      'passation'   => new sfValidatorBoolean(array('required' => false)),
      'salle'       => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'phone'       => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'facebook'    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'joignable'   => new sfValidatorBoolean(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('asso[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Asso';
  }

}
