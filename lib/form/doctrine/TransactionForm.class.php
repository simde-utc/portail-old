<?php

/**
 * Transaction form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TransactionForm extends BaseTransactionForm
{
  public function configure()
  {
      $this->widgetSchema['asso_id'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['compte_id'] = new sfWidgetFormDoctrineChoice(array(
          'model' => $this->getRelatedModelName('CompteBanquaire'),
          'query' => CompteBanquaireTable::getInstance()->getAllForAsso($this->getObject()->getAsso()),
          'add_empty' => false
      ));
      $this->validatorSchema['compte_id'] = new sfValidatorDoctrineChoice(array(
          'model' => $this->getRelatedModelName('CompteBanquaire'),
          'query' => CompteBanquaireTable::getInstance()->getAllForAsso($this->getObject()->getAsso()),
      ));
      
      $this->validatorSchema['debit'] = new sfValidatorBoolean();
      
      unset($this['created_at'], $this['updated_at'], $this['deleted_at'], $this['note_de_frais_id'], $this['budget_poste_id']);
      
      $this->widgetSchema['debit'] = new sfWidgetFormInputCheckbox(array(),array('style' => 'display : inline-block;'));
      $this->setDefault('debit',true);
      
      $this->getWidgetSchema()->setPositions(array(
         'id',
         'asso_id',
         'compte_id',
         'libelle',
         'debit',
         'montant',
         'commentaire',
         'date_transaction',
         'date_rapprochement',
         'date_rapprochement',
         'moyen_id',
         'moyen_commentaire'));
      
      $this->validatorSchema['moyen_commentaire']->setOption('required', false);
  }
  
  public function processValues($values)
  {
      $isCheckedDebit = $values['debit'];
      if($isCheckedDebit)
          $values['montant'] = - $values['montant'];
      return parent::processValues($values);
  }
}