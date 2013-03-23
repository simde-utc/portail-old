<?php

/**
 * budget actions.
 *
 * @package    simde
 * @subpackage budget
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class budgetActions extends sfActions
{
  private function checkAuthorisation($asso) {
    $b = !$this->getUser()->isAuthenticated() || !$this->getUser()->getGuardUser()->hasAccess($asso->getLogin(), 0x100);
    $this->redirectUnless($b, '/');
    return $b;
  }

  public function executeIndex(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    if ($this->checkAuthorisation($this->asso)) {
      $this->budgets = BudgetTable::getInstance()->getBudgetsForAsso($this->asso)->execute();
    }
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->budget = $this->getRoute()->getObject();
    if ($this->checkAuthorisation($this->budget->getAsso())) {
      $this->categories = $this->budget->getCategories()->execute();
      $this->assos = $this->budget->getAsso();
    }
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    if ($this->checkAuthorisation($this->asso)) {
      $this->form = new BudgetForm();
      $this->form->setDefault('asso_id', $this->asso->getPrimaryKey());
    }
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new BudgetForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->budget = $this->getRoute()->getObject();
    $this->asso = $this->budget->getAsso();
    if ($this->checkAuthorisation($this->asso)) {
      $this->form = new BudgetForm($this->budget);
    }
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($budget = BudgetTable::getInstance()->find(array($request->getParameter('id'))), sprintf('Object budget does not exist (%s).', $request->getParameter('id'))); 
    $this->form = new BudgetForm($budget);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $budget = $this->getRoute()->getObject();
    $asso = $budget->getAsso();
    if ($this->checkAuthorisation($asso)) {
      $budget->delete();

      $this->redirect('budget_list', $asso);
    }
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $budget = $form->save();
      $this->redirect('budget_show', $budget);
    }
  }
}
