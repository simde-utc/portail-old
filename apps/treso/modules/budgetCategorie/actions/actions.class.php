<?php

/**
 * budgetCategorie actions.
 *
 * @package    simde
 * @subpackage budgetCategorie
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class budgetCategorieActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();    
    $this->budget_categories = BudgetCategorieTable::getInstance()->getActiveCategories($this->asso->getId());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    $this->form = new BudgetCategorieForm();
    $this->form->setDefault('asso_id', $this->asso->getPrimaryKey());
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $budget_categorie = new BudgetCategorie();
    $this->asso = AssoTable::getInstance()->find($request->getParameter('budget_categorie')['asso_id']);
    $budget_categorie->setAsso($this->asso);
    
    $this->form = new BudgetCategorieForm();
    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($budget_categorie = Doctrine_Core::getTable('BudgetCategorie')->find(array($request->getParameter('id'))), sprintf('Object budget_categorie does not exist (%s).', $request->getParameter('id')));
    $this->budget_categorie = Doctrine_Core::getTable('BudgetCategorie')->find(array($request->getParameter('id')));
    $this->asso = $this->budget_categorie->getAsso();
    $this->form = new BudgetCategorieForm($budget_categorie);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($budget_categorie = Doctrine_Core::getTable('BudgetCategorie')->find(array($request->getParameter('id'))), sprintf('Object budget_categorie does not exist (%s).', $request->getParameter('id')));
    $this->form = new BudgetCategorieForm($budget_categorie);
    $this->asso = $budget_categorie->getAsso();
    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {

    $request->checkCSRFProtection();

    $this->forward404Unless($budget_categorie = Doctrine_Core::getTable('BudgetCategorie')->find(array($request->getParameter('id'))), sprintf('Object budget_categorie does not exist (%s).', $request->getParameter('id')));
    $budget_categorie->delete();

    $asso = $budget_categorie->getAsso();
    $this->redirect($this->generateUrl('budget_categorie', array(
            'login' => $asso->getName())));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $budget_categorie = $form->save();
      $asso = $budget_categorie->getAsso();
      $this->redirect($this->generateUrl('budget_categorie', array(
            'login' => $asso->getName())));
    }
  }
}
