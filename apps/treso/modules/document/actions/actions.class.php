<?php

/**
 * document actions.
 *
 * @package    simde
 * @subpackage document
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class documentActions extends tresoActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    $this->checkAuthorisation($this->asso);

    $this->getResponse()->setSlot('current_asso', $this->asso);
  }

  public function executeList(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    $this->checkAuthorisation($this->asso);

    $this->documents = DocumentTable::getInstance()->getAllForAsso($this->asso)->execute();
  }

  public function executeNew(sfWebRequest $request) {
    $this->asso = $this->getRoute()->getObject();
    $this->checkAuthorisation($this->asso);

    $doc = new Document();
    $doc->setAsso($this->asso);
    $this->form = new DocumentForm($doc);
    $this->getResponse()->setSlot('current_asso', $this->asso);
  }

  public function executeShow(sfWebRequest $request)
  {
    $document = $this->getRoute()->getObject();
    $asso = $document->getAsso();
    $this->checkAuthorisation($asso);

    $path = $document->getPath();
    if(file_exists($path)) {
      $infos = new finfo(FILEINFO_MIME_TYPE);
      $mime = $infos->file($path);

      header('Content-type: '.$mime);
      readfile($path);
      return sfView::NONE;
    } else {
      $this->getResponse()->setSlot('current_asso', $asso);
    }
  }

  public function executeAdd(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::PUT));

    $form = new DocumentForm();
    $request_params = $request->getParameter($form->getName());
    $asso = AssoTable::getInstance()->find($request_params['asso_id']);
    $this->checkAuthorisation($asso);

    $form->setFilePath(Document::getPathForAsso($asso));
    $files = $request->getFiles($form->getName());
    $form->bind($request->getParameter($form->getName()), $files);

    if ( $form->isValid() ) {
      $form->setValue('auteur', $this->getUser()->getGuardUser()->getPrimaryKey());
      $doc = $form->save();

      $this->redirect('documents', $asso);
    } else {
      $this->form = $form;
      $this->setTemplate('show', $this->transaction);
      $this->getResponse()->setSlot('current_asso', $asso);
    }
  }

  public function executeDeleteFromTransaction(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $this->forward404Unless($document = DocumentTable::getInstance()->find(array($request->getParameter('id'))), sprintf('Object document does not exist (%s).', $request->getParameter('id')));
    $this->checkAuthorisation($document->getAsso());
    $transaction = $document->getTransaction();
    $document->deleteAndUnlink();

    $this->redirect('transaction_show', $transaction);
  }
}
