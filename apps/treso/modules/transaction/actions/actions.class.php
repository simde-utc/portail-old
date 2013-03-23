<?php

/**
 * transaction actions.
 *
 * @package    simde
 * @subpackage transaction
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class transactionActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    $this->transactions = TransactionTable::getInstance()->getAllForAsso($this->asso)->execute();
    $this->getResponse()->setSlot('current_asso', $this->asso);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    $transaction = new Transaction();
    $transaction->setAsso($this->asso);
    $this->form = new TransactionForm($transaction);
    $this->getResponse()->setSlot('current_asso', $this->asso);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $request_transaction = $request->getParameter('transaction');
    $this->asso = AssoTable::getInstance()->find($request_transaction['asso_id']);
    $transaction = new Transaction();
    $transaction->setAsso($this->asso);
    $this->form = new TransactionForm($transaction);

    $this->processForm($request, $this->form);
  //  $this->asso;
    $this->setTemplate('new');
    $this->getResponse()->setSlot('current_asso', $this->asso);
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($transaction = Doctrine_Core::getTable('Transaction')->find(array($request->getParameter('id'))), sprintf('Object transaction does not exist (%s).', $request->getParameter('id')));
    $this->form = new TransactionForm($transaction);
    $this->getResponse()->setSlot('current_asso', $transaction->getAsso());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($transaction = Doctrine_Core::getTable('Transaction')->find(array($request->getParameter('id'))), sprintf('Object transaction does not exist (%s).', $request->getParameter('id')));
    $this->form = new TransactionForm($transaction);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
    $this->getResponse()->setSlot('current_asso', $transaction->getAsso());
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $this->forward404Unless($transaction = Doctrine_Core::getTable('Transaction')->find(array($request->getParameter('id'))), sprintf('Object transaction does not exist (%s).', $request->getParameter('id')));
    $a = $transaction->getAsso()->getName();

    $transaction->delete();

    $this->redirect('transaction', array('login' => $a ));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $transaction = $form->save();

      $this->redirect('transaction', $form->getObject()->getAsso());
    }
  }
}
