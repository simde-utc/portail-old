<?php

/**
 * Asso filter form base class.
 *
 * @package    simde
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAssoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'login'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pole_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pole'), 'add_empty' => true)),
      'type_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Type'), 'add_empty' => true)),
      'summary'     => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(),
      'logo'        => new sfWidgetFormFilterInput(),
      'active'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'passation'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'salle'       => new sfWidgetFormFilterInput(),
      'phone'       => new sfWidgetFormFilterInput(),
      'facebook'    => new sfWidgetFormFilterInput(),
      'joignable'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorPass(array('required' => false)),
      'login'       => new sfValidatorPass(array('required' => false)),
      'pole_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pole'), 'column' => 'id')),
      'type_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Type'), 'column' => 'id')),
      'summary'     => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'logo'        => new sfValidatorPass(array('required' => false)),
      'active'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'passation'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'salle'       => new sfValidatorPass(array('required' => false)),
      'phone'       => new sfValidatorPass(array('required' => false)),
      'facebook'    => new sfValidatorPass(array('required' => false)),
      'joignable'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('asso_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Asso';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'name'        => 'Text',
      'login'       => 'Text',
      'pole_id'     => 'ForeignKey',
      'type_id'     => 'ForeignKey',
      'summary'     => 'Text',
      'description' => 'Text',
      'logo'        => 'Text',
      'active'      => 'Boolean',
      'passation'   => 'Boolean',
      'salle'       => 'Text',
      'phone'       => 'Text',
      'facebook'    => 'Text',
      'joignable'   => 'Boolean',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
