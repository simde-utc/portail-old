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
    $this->widgetSchema['budget_categorie_id'] = new sfWidgetFormDoctrineChoice(array(
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
    $this->validatorSchema['prix_unitaire'] = new ValidatorNumberNotNull(array('not_null' => true));
    $this->validatorSchema['nombre'] = new sfValidatorNumber(array('min' => 1));
  }
}
