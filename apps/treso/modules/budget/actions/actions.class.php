<?php

/**
 * budget actions.
 *
 * @package    simde
 * @subpackage budget
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class budgetActions extends tresoActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    $this->checkAuthorisation($this->asso);

    $this->budgets = BudgetTable::getInstance()->getBudgetsForAsso($this->asso)->execute();
    $this->getResponse()->setSlot('current_asso', $this->asso);
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->budget = $this->getRoute()->getObject();
    $this->checkAuthorisation($this->budget->getAsso());

    $this->categories = $this->budget->getCategoriesWithEntry()->execute();
    $this->unused_categories = $this->budget->getCategoriesWithoutEntry()->execute();
    $this->assos = $this->budget->getAsso();
    $this->getResponse()->setSlot('current_asso', $this->assos);
  }

  public function executeExport(sfWebRequest $request)
  {
    $budget = $this->getRoute()->getObject();
    $asso = $budget->getAsso();
    $this->checkAuthorisation($budget->getAsso());

    $pdf = new Pdf($asso);
    $categories = $budget->getCategoriesWithEntry()->execute();

    $html = $this->getPartial('budget/pdf',compact(array('categories','asso', 'budget', 'transactions')));

    $path = $pdf->generate('transactions',$html);

    header('Content-type: application/pdf');
    readfile($path);

    return sfView::NONE;
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    $this->checkAuthorisation($this->asso);
    $this->form = new BudgetForm();
    $this->form->setDefault('asso_id', $this->asso->getPrimaryKey());
    
    $this->getResponse()->setSlot('current_asso', $this->asso);
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
    $this->checkAuthorisation($this->asso);

    $this->form = new BudgetForm($this->budget);

    $this->getResponse()->setSlot('current_asso', $this->asso);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($budget = BudgetTable::getInstance()->find(array($request->getParameter('id'))), sprintf('Object budget does not exist (%s).', $request->getParameter('id'))); 
    $this->form = new BudgetForm($budget);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
    
    $this->getResponse()->setSlot('current_asso', $this->form->getObject()->getAsso());
  }

  public function executeDelete(sfWebRequest $request)
  {
    $budget = $this->getRoute()->getObject();
    $asso = $budget->getAsso();
    $this->checkAuthorisation($asso);

    $budget->delete();

    $this->redirect('budget_list', $asso);
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
