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
    $this->documents = DocumentTable::getInstance()->getAllForAsso($this->asso)->execute();
    $this->getResponse()->setSlot('current_asso', $this->asso);
  }

  public function executeShow(sfWebRequest $request)
  {
    $document = $this->getRoute()->getObject();
    $asso = $document->getAsso();
    $this->checkAuthorisation($asso);

    $path = $document->getPath();
    if(file_exists($path)) {
      header('Content-type: application/pdf');
      readfile($path);
      return sfView::NONE;
    } else {
      $this->getResponse()->setSlot('current_asso', $asso);
    }
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new DocumentForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->form = new DocumentForm($this->getRoute()->getObject());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->form = new DocumentForm($this->getRoute()->getObject());

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
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

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $document = $form->save();

      $this->redirect('document/edit?id='.$document->getId());
    }
  }
}
