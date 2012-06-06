<?php

/**
 * Etat filter form base class.
 *
 * @package    simde
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEtatFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nom'        => new sfWidgetFormFilterInput(),
      'disponible' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'nom'        => new sfValidatorPass(array('required' => false)),
      'disponible' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('etat_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Etat';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'nom'        => 'Text',
      'disponible' => 'Boolean',
    );
  }
}
