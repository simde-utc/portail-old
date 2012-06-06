<?php

/**
 * Emprunt form base class.
 *
 * @method Emprunt getObject() Returns the current form's model object
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEmpruntForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'materiel_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Materiel'), 'add_empty' => true)),
      'user_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'asso_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Asso'), 'add_empty' => true)),
      'nombre'      => new sfWidgetFormInputText(),
      'recu'        => new sfWidgetFormInputCheckbox(),
      'rendu'       => new sfWidgetFormInputCheckbox(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'materiel_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Materiel'), 'required' => false)),
      'user_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'asso_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Asso'), 'required' => false)),
      'nombre'      => new sfValidatorInteger(array('required' => false)),
      'recu'        => new sfValidatorBoolean(array('required' => false)),
      'rendu'       => new sfValidatorBoolean(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('emprunt[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Emprunt';
  }

}
