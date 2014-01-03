<?php

/**
 * galerie actions.
 *
 * @package    simde
 * @subpackage galerie
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class galerieActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->galerie_photos = Doctrine_Core::getTable('GaleriePhoto')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new GaleriePhotoForm();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->galerie_photo = Doctrine_Core::getTable('GaleriePhoto')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->galerie_photo);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new GaleriePhotoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($galerie_photo = Doctrine_Core::getTable('GaleriePhoto')->find(array($request->getParameter('id'))), sprintf('Object galerie_photo does not exist (%s).', $request->getParameter('id')));
    $this->form = new GaleriePhotoForm($galerie_photo);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($galerie_photo = Doctrine_Core::getTable('GaleriePhoto')->find(array($request->getParameter('id'))), sprintf('Object galerie_photo does not exist (%s).', $request->getParameter('id')));
    $this->form = new GaleriePhotoForm($galerie_photo);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($galerie_photo = Doctrine_Core::getTable('GaleriePhoto')->find(array($request->getParameter('id'))), sprintf('Object galerie_photo does not exist (%s).', $request->getParameter('id')));
    $galerie_photo->delete();

    $this->redirect('galerie/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $galerie_photo = $form->save();

      $this->redirect('galerie/edit?id='.$galerie_photo->getId());
    }
  }
}
