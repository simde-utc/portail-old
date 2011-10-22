<?php

/**
 * Event form base class.
 *
 * @method Event getObject() Returns the current form's model object
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEventForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'asso_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Asso'), 'add_empty' => true)),
      'type_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Type'), 'add_empty' => true)),
      'name'        => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
      'start_date'  => new sfWidgetFormDateTime(),
      'end_date'    => new sfWidgetFormDateTime(),
      'is_public'   => new sfWidgetFormInputCheckbox(),
      'is_weekmail' => new sfWidgetFormInputCheckbox(),
      'place'       => new sfWidgetFormTextarea(),
      'affiche'     => new sfWidgetFormTextarea(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'asso_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Asso'), 'required' => false)),
      'type_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Type'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'description' => new sfValidatorString(array('required' => false)),
      'start_date'  => new sfValidatorDateTime(array('required' => false)),
      'end_date'    => new sfValidatorDateTime(array('required' => false)),
      'is_public'   => new sfValidatorBoolean(array('required' => false)),
      'is_weekmail' => new sfValidatorBoolean(array('required' => false)),
      'place'       => new sfValidatorString(array('required' => false)),
      'affiche'     => new sfValidatorString(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('event[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Event';
  }

}
