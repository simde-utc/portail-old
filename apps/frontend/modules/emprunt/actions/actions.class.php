<?php

/**
 * emprunt actions.
 *
 * @package    simde
 * @subpackage emprunt
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class empruntActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->emprunts = Doctrine_Core::getTable('Emprunt')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new EmpruntForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EmpruntForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($emprunt = Doctrine_Core::getTable('Emprunt')->find(array($request->getParameter('id'))), sprintf('Object emprunt does not exist (%s).', $request->getParameter('id')));
    $this->form = new EmpruntForm($emprunt);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($emprunt = Doctrine_Core::getTable('Emprunt')->find(array($request->getParameter('id'))), sprintf('Object emprunt does not exist (%s).', $request->getParameter('id')));
    $this->form = new EmpruntForm($emprunt);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($emprunt = Doctrine_Core::getTable('Emprunt')->find(array($request->getParameter('id'))), sprintf('Object emprunt does not exist (%s).', $request->getParameter('id')));
    $emprunt->delete();

    $this->redirect('emprunt/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $emprunt = $form->save();

      $this->redirect('emprunt/edit?id='.$emprunt->getId());
    }
  }
}
