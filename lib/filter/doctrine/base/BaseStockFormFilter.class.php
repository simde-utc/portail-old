<?php

/**
 * Stock filter form base class.
 *
 * @package    simde
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseStockFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'materiel_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Materiel'), 'add_empty' => true)),
      'etat_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etat'), 'add_empty' => true)),
      'nombre'      => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'materiel_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Materiel'), 'column' => 'id')),
      'etat_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Etat'), 'column' => 'id')),
      'nombre'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('stock_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Stock';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'materiel_id' => 'ForeignKey',
      'etat_id'     => 'ForeignKey',
      'nombre'      => 'Number',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
