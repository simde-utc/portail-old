<?php

/**
 * stock actions.
 *
 * @package    simde
 * @subpackage stock
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class stockActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->stocks = Doctrine_Core::getTable('Stock')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new StockForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new StockForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($stock = Doctrine_Core::getTable('Stock')->find(array($request->getParameter('id'))), sprintf('Object stock does not exist (%s).', $request->getParameter('id')));
    $this->form = new StockForm($stock);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($stock = Doctrine_Core::getTable('Stock')->find(array($request->getParameter('id'))), sprintf('Object stock does not exist (%s).', $request->getParameter('id')));
    $this->form = new StockForm($stock);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($stock = Doctrine_Core::getTable('Stock')->find(array($request->getParameter('id'))), sprintf('Object stock does not exist (%s).', $request->getParameter('id')));
    $stock->delete();

    $this->redirect('stock/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $stock = $form->save();

      $this->redirect('stock/edit?id='.$stock->getId());
    }
  }
}
