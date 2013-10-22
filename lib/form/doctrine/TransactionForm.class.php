<?php

/**
 * Transaction form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TransactionForm extends BaseTransactionForm {

  public function configure() {
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
    
    $this->widgetSchema['budget_poste_id'] = new sfWidgetFormDoctrineChoice(array(
        'model' => $this->getRelatedModelName('BudgetPoste'),
        'query' => BudgetPosteTable::getInstance()->getAllForAsso($this->getObject()->getAsso()),
        'method' => 'transactionNewRepr',
        'add_empty' => '- Pas de poste lié -',
        'label' => 'Poste du budget'
    ));
    $this->validatorSchema['budget_poste_id'] = new sfValidatorDoctrineChoice(array(
        'model' => $this->getRelatedModelName('BudgetPoste'),
        'query' => BudgetPosteTable::getInstance()->getAllForAsso($this->getObject()->getAsso()),
        'required' => false,
    ));
        
    $this->widgetSchema['date_transaction'] = new portailWidgetFormDate();
    $this->widgetSchema['date_rapprochement'] = new portailWidgetFormDate(array(), array('placeholder' => 'À compléter plus tard'));

    unset($this['created_at'], $this['updated_at'], $this['deleted_at'], $this['note_de_frais_id']);

    $this->widgetSchema['montant'] = new portailWidgetFormMontant();
    $this->validatorSchema['montant'] = new portailValidatorMontant();

    $this->getWidgetSchema()->setPositions(array(
        'id',
        'asso_id',
        'compte_id',
        'budget_poste_id',
        'libelle',
        'montant',
        'commentaire',
        'date_transaction',
        'date_rapprochement',
        'date_rapprochement',
        'moyen_id',
        'moyen_commentaire'));

    $this->widgetSchema['libelle'] = new sfWidgetFormInput(array('label'=>'Libellé'), array('placeholder'=>'Nom de la transaction'));

    $this->widgetSchema['moyen_commentaire'] = new sfWidgetFormInput(array(),
        array('placeholder' => 'n° de chèque ou nom de membre'));
    $this->validatorSchema['moyen_commentaire']->setOption('required', false);

    $this->validatorSchema['date_rapprochement'] = new sfValidatorDate(array('required' => false));

    // soit la date de rapprochement est nulle, soit elle est plus tard que la date de transaction
    $this->validatorSchema->setPostValidator(
        new sfValidatorOr(array(
                new sfValidatorSchemaFilter('date_rapprochement', new portailValidatorNull(array('required'=>false))),
                new sfValidatorSchemaCompare('date_rapprochement', sfValidatorSchemaCompare::GREATER_THAN, 'date_transaction')
            ), array(),
            array('invalid' => 'La date de rapprochement doit être supérieure à la date de la transaction')
            )
        );
  }

}
