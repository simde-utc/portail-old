<?php

/**
 * transaction actions.
 *
 * @package    simde
 * @subpackage transaction
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class transactionActions extends tresoActions {

  public function executeIndex(sfWebRequest $request) {
    $this->asso = $this->getRoute()->getObject();

    $this->checkAuthorisation($this->asso);
    $this->transactions = TransactionTable::getInstance()->getJournalForAsso($this->asso)->orderBy('q.date_transaction DESC')->execute();
    $this->getResponse()->setSlot('current_asso', $this->asso);
  }

  public function executeShow(sfWebRequest $request) {
    $this->transaction = $this->getRoute()->getObject();
    $this->checkAuthorisation($this->transaction->getAsso());

    $this->documents = DocumentTable::getInstance()->getAllForTransaction($this->transaction)->execute();

    $document = new Document();
    $document->asso_id = $this->transaction->getAssoId();
    $document->transaction_id = $this->transaction->getPrimaryKey();
    $this->form = new DocumentForm($document);

    $this->getResponse()->setSlot('current_asso', $this->transaction->getAsso());
  }

  public function executeAddDocument(sfWebRequest $request) {
    $this->forward404Unless($request->isMethod(sfRequest::PUT));

    $document = $request->getParameter('document');

    $this->transaction = TransactionTable::getInstance()->find($document['transaction_id']);
    $asso = AssoTable::getInstance()->find($document['asso_id']);
    $this->checkAuthorisation($asso);

    $form = new DocumentForm();
    $files = $request->getFiles($form->getName());
    $form->bind($request->getParameter($form->getName()), $files);

    $infos = new finfo(FILEINFO_MIME_TYPE);

    if ($form->isValid() and $infos->file($files['fichier']['tmp_name']) == 'application/pdf') {
      $fichier = $this->transaction->getPrimaryKey() . '-' . date('Y-m-d-H-i-s') . '-' . Doctrine_Inflector::urlize($files['fichier']['name']);
      if (substr($fichier, -4) == '-pdf')
        $fichier = substr($fichier, 0, -4);
      $fichier .= '.pdf';
      $form->setValue('fichier', $fichier);
      $form->setValue('auteur', $this->getUser()->getGuardUser()->getPrimaryKey());
      $doc = $form->save();

      $path = $doc->getPath();
      $dir = substr($path, 0, -strlen($fichier));
      if(!is_dir($dir))
        mkdir($dir);
      move_uploaded_file($files['fichier']['tmp_name'], $path);

      $this->redirect('transaction_show', $this->transaction);
    } else {
      $this->form = $form;
      $this->setTemplate('show', $this->transaction);
      $this->getResponse()->setSlot('current_asso', $asso);
    }
  }

  public function executeNew(sfWebRequest $request) {
    if ($request->getParameter('poste_id')){
      $this->forward404Unless(is_numeric($request->getParameter('poste_id')));
      $this->asso = AssoTable::getInstance()->find($request->getParameter('asso_id'));
      $this->poste_id = $request->getParameter('poste_id');
    } else {
      $this->asso = $this->getRoute()->getObject();
    }

    $this->checkAuthorisation($this->asso);
    $transaction = new Transaction();
    $transaction->setAsso($this->asso);
    $this->form = new TransactionForm($transaction);
    if (isset($this->poste_id)) {
      $this->form->setDefault('budget_poste_id', $this->poste_id);
    }
    $this->getResponse()->setSlot('current_asso', $this->asso);
    $this->getResponse()->setSlot('current_asso', $this->asso);
  }

  public function executeCreate(sfWebRequest $request) {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $request_transaction = $request->getParameter('transaction');
    $this->asso = AssoTable::getInstance()->find($request_transaction['asso_id']);
    $this->checkAuthorisation($this->asso);
    $transaction = new Transaction();
    $transaction->setAsso($this->asso);
    $this->form = new TransactionForm($transaction);
    $this->processForm($request, $this->form);
    $this->setTemplate('new');
    $this->getResponse()->setSlot('current_asso', $this->asso);
  }

  public function executeEdit(sfWebRequest $request) {
    $this->forward404Unless($transaction = Doctrine_Core::getTable('Transaction')->find(array($request->getParameter('id'))), sprintf('Object transaction does not exist (%s).', $request->getParameter('id')));
    $this->checkAuthorisation($transaction->getAsso());
    $this->form = new TransactionForm($transaction);
    $this->getResponse()->setSlot('current_asso', $transaction->getAsso());
  }

  public function executeUpdate(sfWebRequest $request) {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($transaction = Doctrine_Core::getTable('Transaction')->find(array($request->getParameter('id'))), sprintf('Object transaction does not exist (%s).', $request->getParameter('id')));
    $this->checkAuthorisation($transaction->getAsso());
    $this->form = new TransactionForm($transaction);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
    $this->getResponse()->setSlot('current_asso', $transaction->getAsso());
  }

  public function executeDelete(sfWebRequest $request) {
    $request->checkCSRFProtection();
    $this->forward404Unless($transaction = Doctrine_Core::getTable('Transaction')->find(array($request->getParameter('id'))), sprintf('Object transaction does not exist (%s).', $request->getParameter('id')));
    $this->checkAuthorisation($transaction->getAsso());
    $transaction->delete();
    $this->redirect('transaction', array('login' => $transaction->getAsso()->getName()));
  }

  protected function processForm(sfWebRequest $request, sfForm $form) {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $transaction = $form->save();

      $this->redirect('transaction', $form->getObject()->getAsso());
    }
  }

  public function executePdf(sfWebRequest $request) {
    $asso = $this->getRoute()->getObject();
    $this->checkAuthorisation($asso);

    $transactions = TransactionTable::getInstance()->getAllForAsso($asso)->execute();

    $html = $this->getPartial('transaction/pdf',compact(array('transactions','asso')));
    $nom = date('Y-m-d-H-i-s');

    $doc = new Document();
    $doc->setNom('Export du journal des transactions');
    $doc->setAsso($asso);
    $doc->setUser($this->getUser()->getGuardUser());
    $doc->setTypeFromSlug('transactions');
    $path = $doc->generatePDF($asso->getName() . ' : Livre de compte', $nom, $html);
    $doc->save();

    header('Content-type: application/pdf');
    readfile($path);
    return sfView::NONE;
  }
}
