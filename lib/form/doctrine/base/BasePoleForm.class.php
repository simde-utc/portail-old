<?php

/**
 * Pole form base class.
 *
 * @method Pole getObject() Returns the current form's model object
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePoleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'asso_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Infos'), 'add_empty' => true)),
      'couleur' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'asso_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Infos'), 'required' => false)),
      'couleur' => new sfValidatorString(array('max_length' => 7, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pole[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pole';
  }

}
