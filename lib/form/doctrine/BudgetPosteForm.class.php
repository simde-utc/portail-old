<?php

/**
 * BudgetPoste form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BudgetPosteForm extends BaseBudgetPosteForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at'], $this['deleted_at']);
    $this->widgetSchema['budget_categorie_id'] = new sfWidgetFormDoctrineChoice(array('label' => 'Catégorie',
          'model' => $this->getRelatedModelName('BudgetCategorie'),
          'query' => BudgetCategorieTable::getInstance()->getAllForAsso($this->getObject()->getAsso()),
          'add_empty' => false
    ));
    $this->validatorSchema['budget_categorie_id'] = new sfValidatorDoctrineChoice(array(
          'model' => $this->getRelatedModelName('BudgetCategorie'),
          'query' => BudgetCategorieTable::getInstance()->getAllForAsso($this->getObject()->getAsso()),
    ));
    $this->widgetSchema['asso_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['budget_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['prix_unitaire'] = new portailWidgetFormMontant();
    $this->validatorSchema['prix_unitaire'] = new portailValidatorMontant();
    $this->validatorSchema['nombre'] = new sfValidatorNumber(array('min' => 1));

    $this->validatorSchema->setPostValidator(new sfValidatorSchemaFilter('prix_unitaire', new ValidatorNumberNotNull(array('not_null' => true))));

    $this->getWidgetSchema()->setPositions(array('id',
                                                 'asso_id',
                                                 'budget_id',
                                                 'nom',
                                                 'budget_categorie_id',
                                                 'nombre',
                                                 'prix_unitaire',
                                                 'commentaire'));
  }

}
