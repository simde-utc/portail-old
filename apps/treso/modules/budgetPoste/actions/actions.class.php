<?php

/**
 * budgetPoste actions.
 *
 * @package    simde
 * @subpackage budgetPoste
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class budgetPosteActions extends sfActions
{
  public function executeNew(sfWebRequest $request)
  {
    $this->forward404Unless($this->budget = BudgetTable::getInstance()->find(array($request->getParameter('budget'))), sprintf('Object budget does not exist (%s).', $request->getParameter('budget')));
    $this->forward404Unless($this->categorie = BudgetCategorieTable::getInstance()->find(array($request->getParameter('categorie'))), sprintf('Object budget does not exist (%s).', $request->getParameter('categorie')));

    $this->form = new BudgetPosteForm();
    $this->form->setDefault('budget_id', $this->budget->getPrimaryKey());
    $this->form->setDefault('budget_categorie_id', $this->categorie->getPrimaryKey());
    $this->form->setDefault('asso_id', $this->budget->getAssoId());
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new BudgetPosteForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($this->poste = Doctrine_Core::getTable('BudgetPoste')->find(array($request->getParameter('id'))), sprintf('Object budget_poste does not exist (%s).', $request->getParameter('id')));
    $this->form = new BudgetPosteForm($this->poste);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($this->poste = Doctrine_Core::getTable('BudgetPoste')->find(array($request->getParameter('id'))), sprintf('Object budget_poste does not exist (%s).', $request->getParameter('id')));
    $this->form = new BudgetPosteForm($this->poste);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->forward404Unless($budget_poste = Doctrine_Core::getTable('BudgetPoste')->find(array($request->getParameter('id'))), sprintf('Object budget_poste does not exist (%s).', $request->getParameter('id')));
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
