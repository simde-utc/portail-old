<?php

/**
 * NoteDeFrais form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NoteDeFraisForm extends BaseNoteDeFraisForm
{
  public function configure()
  {
    $this->widgetSchema['asso_id'] = new SfWidgetFormInputHidden();

    $this->widgetSchema['transactions'] = new sfWidgetFormDoctrineChoice(array(
          'model' => 'Transaction',
          'query' => TransactionTable::getInstance()->getRemboursablesForAsso($this->getObject()->getAsso()),
          'add_empty' => false,
          'multiple' => true
    ));
    $this->validatorSchema['transactions'] = new sfValidatorDoctrineChoice(array(
          'model' => 'Transaction',
          'query' => TransactionTable::getInstance()->getRemboursablesForAsso($this->getObject()->getAsso()),
          'multiple' => true,
          'min' => 1
    ));
    $this->validatorSchema['transaction_id'] = new sfValidatorPass();

    // on ajoute tous les champs liés à la transaction
    $this->widgetSchema['moyen_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => 'TransactionMoyen',
            'add_empty' => false
    ));
    $this->validatorSchema['moyen_id'] = new sfValidatorDoctrineChoice(array(
            'model' => 'TransactionMoyen'
    ));

    $this->widgetSchema['compte_id'] = new sfWidgetFormDoctrineChoice(array(
      'model' => 'CompteBanquaire',
      'query' => CompteBanquaireTable::getInstance()->getAllForAsso($this->getObject()->getAsso()),
      'add_empty' => false
    ));
    $this->validatorSchema['compte_id'] = new sfValidatorDoctrineChoice(array(
      'model' => 'CompteBanquaire',
      'query' => CompteBanquaireTable::getInstance()->getAllForAsso($this->getObject()->getAsso()),
    ));

    $this->widgetSchema['moyen_commentaire'] = new sfWidgetFormTextarea();
    $this->validatorSchema['moyen_commentaire'] = new sfValidatorString(array('required' => false));

    unset($this['created_at'], $this['updated_at'], $this['deleted_at']);
  }

  /**
   * the missing set value function to change a default after the values are bound
   * @param string $field the name of the field
   * @param mixed $value the new value
   */
  public function setValue($field, $value) {
      $this->values[$field] = $value; // set the value for this request
      $this->taintedValues[$field] = $value; // override the value entered by the user
      $this->resetFormFields(); // force a refresh on the field schema
  }
}
