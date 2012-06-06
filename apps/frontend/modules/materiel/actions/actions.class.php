<?php

/**
 * materiel actions.
 *
 * @package    simde
 * @subpackage materiel
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class materielActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->materiels = Doctrine_Core::getTable('Materiel')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MaterielForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MaterielForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($materiel = Doctrine_Core::getTable('Materiel')->find(array($request->getParameter('id'))), sprintf('Object materiel does not exist (%s).', $request->getParameter('id')));
    $this->form = new MaterielForm($materiel);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($materiel = Doctrine_Core::getTable('Materiel')->find(array($request->getParameter('id'))), sprintf('Object materiel does not exist (%s).', $request->getParameter('id')));
    $this->form = new MaterielForm($materiel);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($materiel = Doctrine_Core::getTable('Materiel')->find(array($request->getParameter('id'))), sprintf('Object materiel does not exist (%s).', $request->getParameter('id')));
    $materiel->delete();

    $this->redirect('materiel/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $materiel = $form->save();

      $this->redirect('materiel/edit?id='.$materiel->getId());
    }
  }
}
