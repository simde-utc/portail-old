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
  public function executeIndex(sfWebRequest $request)
  {
    $asso = $this->getRoute()->getObject();
    $this->budgets = BudgetTable::getInstance()->getBudgetsForAsso($asso)->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new BudgetForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new BudgetForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->form = new BudgetForm($this->getRoute()->getObject());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->form = new BudgetForm($this->getRoute()->getObject());

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->getRoute()->getObject()->delete();

    $this->redirect('budget/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $budget = $form->save();

      $this->redirect('budget/edit?id='.$budget->getId());
    }
  }
}
