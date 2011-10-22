<?php

/**
 * Pole filter form base class.
 *
 * @package    simde
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePoleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'asso_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Infos'), 'add_empty' => true)),
      'couleur' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'asso_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Infos'), 'column' => 'id')),
      'couleur' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pole_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pole';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'asso_id' => 'ForeignKey',
      'couleur' => 'Text',
    );
  }
}
