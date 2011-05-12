<?php

/**
 * Place form base class.
 *
 * @method Place getObject() Returns the current form's model object
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePlaceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'street'     => new sfWidgetFormTextarea(),
      'zipcode'    => new sfWidgetFormInputText(),
      'city'       => new sfWidgetFormInputText(),
      'country'    => new sfWidgetFormInputText(),
      'phone'      => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'street'     => new sfValidatorString(array('required' => false)),
      'zipcode'    => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'city'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'country'    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'phone'      => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('place[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Place';
  }

}
