<?php

/**
 * budgetPrevisionnel actions.
 *
 * @package    simde
 * @subpackage budgetPrevisionnel
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class budgetPrevisionnelActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->budgets = Doctrine_Core::getTable('Budget')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new BudgetForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new BudgetForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($budget = Doctrine_Core::getTable('Budget')->find(array($request->getParameter('id'))), sprintf('Object budget does not exist (%s).', $request->getParameter('id')));
    $this->form = new BudgetForm($budget);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($budget = Doctrine_Core::getTable('Budget')->find(array($request->getParameter('id'))), sprintf('Object budget does not exist (%s).', $request->getParameter('id')));
    $this->form = new BudgetForm($budget);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($budget = Doctrine_Core::getTable('Budget')->find(array($request->getParameter('id'))), sprintf('Object budget does not exist (%s).', $request->getParameter('id')));
    $budget->delete();

    $this->redirect('budgetPrevisionnel/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $budget = $form->save();

      $this->redirect('budgetPrevisionnel/edit?id='.$budget->getId());
    }
  }
}
