<?php

/**
 * UserSemestre filter form base class.
 *
 * @package    simde
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUserSemestreFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profile'), 'add_empty' => true)),
      'branche_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Branche'), 'add_empty' => true)),
      'num'         => new sfWidgetFormFilterInput(),
      'abroad'      => new sfWidgetFormFilterInput(),
      'semestre_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Semestre'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profile'), 'column' => 'id')),
      'branche_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Branche'), 'column' => 'id')),
      'num'         => new sfValidatorPass(array('required' => false)),
      'abroad'      => new sfValidatorPass(array('required' => false)),
      'semestre_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Semestre'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('user_semestre_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserSemestre';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'user_id'     => 'ForeignKey',
      'branche_id'  => 'ForeignKey',
      'num'         => 'Text',
      'abroad'      => 'Text',
      'semestre_id' => 'ForeignKey',
    );
  }
}
