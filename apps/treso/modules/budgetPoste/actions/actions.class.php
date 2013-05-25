<?php

/**
 * budgetPoste actions.
 *
 * @package    simde
 * @subpackage budgetPoste
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class budgetPosteActions extends tresoActions
{
  public function executeNew(sfWebRequest $request)
  {
    $this->forward404Unless($this->budget = BudgetTable::getInstance()->find(array($request->getParameter('budget'))), sprintf('Object budget does not exist (%s).', $request->getParameter('budget')));
    $this->forward404Unless($this->categorie = BudgetCategorieTable::getInstance()->find(array($request->getParameter('categorie'))), sprintf('Object budget does not exist (%s).', $request->getParameter('categorie')));
    $this->checkAuthorisation($this->budget->getAsso());

    $poste = new BudgetPoste();
    $poste->setBudget($this->budget);
    $poste->setBudgetCategorie($this->categorie);
    $poste->setAsso($this->budget->getAsso());
    $this->form = new BudgetPosteForm($poste);

    $this->getResponse()->setSlot('current_asso', $this->budget->getAsso());
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $request_poste = $request->getParameter('budget_poste');
    $this->budget = BudgetTable::getInstance()->find($request_poste['budget_id']);
    $this->asso = $this->budget->getAsso();
    $this->checkAuthorisation($this->asso);
    $poste = new BudgetPoste();
    $poste->setAsso($this->asso);
    $this->form = new BudgetPosteForm($poste);

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
    $this->getResponse()->setSlot('current_asso', $this->asso);
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($this->poste = Doctrine_Core::getTable('BudgetPoste')->find(array($request->getParameter('id'))), sprintf('Object budget_poste does not exist (%s).', $request->getParameter('id')));
    $this->checkAuthorisation($this->poste->getAsso());
    $this->form = new BudgetPosteForm($this->poste);
    $this->getResponse()->setSlot('current_asso', $this->poste->getAsso());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($this->poste = Doctrine_Core::getTable('BudgetPoste')->find(array($request->getParameter('id'))), sprintf('Object budget_poste does not exist (%s).', $request->getParameter('id')));
    $this->checkAuthorisation($this->poste->getAsso());
    $this->form = new BudgetPosteForm($this->poste);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
    $this->getResponse()->setSlot('current_asso', $this->poste->getAsso());
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->forward404Unless($budget_poste = Doctrine_Core::getTable('BudgetPoste')->find(array($request->getParameter('id'))), sprintf('Object budget_poste does not exist (%s).', $request->getParameter('id')));
    $this->checkAuthorisation($budget_poste->getAsso());
    $budget_id = $budget_poste->getBudgetId();
    $budget_poste->delete();

    $this->redirect('budget_show', array('id' => $budget_id));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $budget_poste = $form->save();

      $this->redirect('budget_show', array('id' => $budget_poste->getBudgetId()));
    }
  }
}
