<?php

/**
 * Profile filter form base class.
 *
 * @package    simde
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProfileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'domain'             => new sfWidgetFormFilterInput(),
      'nickname'           => new sfWidgetFormFilterInput(),
      'birthday'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'sexe'               => new sfWidgetFormFilterInput(),
      'mobile'             => new sfWidgetFormFilterInput(),
      'home_place'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('HomePlace'), 'add_empty' => true)),
      'family_place'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FamilyPlace'), 'add_empty' => true)),
      'branche_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Branche'), 'add_empty' => true)),
      'filiere_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Filiere'), 'add_empty' => true)),
      'semestre'           => new sfWidgetFormFilterInput(),
      'other_email'        => new sfWidgetFormFilterInput(),
      'photo'              => new sfWidgetFormFilterInput(),
      'weekmail'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'autorisation_photo' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'cotisant'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'domain'             => new sfValidatorPass(array('required' => false)),
      'nickname'           => new sfValidatorPass(array('required' => false)),
      'birthday'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'sexe'               => new sfValidatorPass(array('required' => false)),
      'mobile'             => new sfValidatorPass(array('required' => false)),
      'home_place'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('HomePlace'), 'column' => 'id')),
      'family_place'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('FamilyPlace'), 'column' => 'id')),
      'branche_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Branche'), 'column' => 'id')),
      'filiere_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Filiere'), 'column' => 'id')),
      'semestre'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'other_email'        => new sfValidatorPass(array('required' => false)),
      'photo'              => new sfValidatorPass(array('required' => false)),
      'weekmail'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'autorisation_photo' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'cotisant'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profile';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'user_id'            => 'ForeignKey',
      'domain'             => 'Text',
      'nickname'           => 'Text',
      'birthday'           => 'Date',
      'sexe'               => 'Text',
      'mobile'             => 'Text',
      'home_place'         => 'ForeignKey',
      'family_place'       => 'ForeignKey',
      'branche_id'         => 'ForeignKey',
      'filiere_id'         => 'ForeignKey',
      'semestre'           => 'Number',
      'other_email'        => 'Text',
      'photo'              => 'Text',
      'weekmail'           => 'Boolean',
      'autorisation_photo' => 'Boolean',
      'cotisant'           => 'Boolean',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
    );
  }
}
