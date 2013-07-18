<?php

/**
 * locaux actions.
 *
 * @package    simde
 * @subpackage locaux
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class locauxActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->charte_locauxs = Doctrine_Core::getTable('CharteLocaux')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CharteLocauxForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CharteLocauxForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($charte_locaux = Doctrine_Core::getTable('CharteLocaux')->find(array($request->getParameter('id'))), sprintf('Object charte_locaux does not exist (%s).', $request->getParameter('id')));
    $this->form = new CharteLocauxForm($charte_locaux);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($charte_locaux = Doctrine_Core::getTable('CharteLocaux')->find(array($request->getParameter('id'))), sprintf('Object charte_locaux does not exist (%s).', $request->getParameter('id')));
    $this->form = new CharteLocauxForm($charte_locaux);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($charte_locaux = Doctrine_Core::getTable('CharteLocaux')->find(array($request->getParameter('id'))), sprintf('Object charte_locaux does not exist (%s).', $request->getParameter('id')));
    $charte_locaux->delete();

    $this->redirect('locaux/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $charte_locaux = $form->save();

      $this->redirect('locaux/edit?id='.$charte_locaux->getId());
    }
  }
}
