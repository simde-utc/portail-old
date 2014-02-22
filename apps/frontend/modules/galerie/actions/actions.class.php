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
      ->getAllGaleries()->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->redirectUnless($event = $this->getRoute()->getObject(), 'event_list');
    if (!$event->userIsPhotographer($this->getUser())){
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('event/show?id=' . $event->getId());
    }
    $this->form = new GaleriePhotoForm();
    $this->form->setDefault('event_id', $this->getRoute()->getObject()->getId());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->galerie_photo = Doctrine_Core::getTable('GaleriePhoto')
                          ->find(array($request->getParameter('id')));
    
    // Hotlinking on a photo of the gallery
    $this->hotLinkedPhoto = intval($request->getParameter('photo'));
    $this->hotLinkedPass = preg_replace(
        "/[^A-Za-z0-9 ]/", '', $request->getParameter('pass'));

    $this->isStudent = $this->getUser()->isAuthenticated();
    $this->isPhotographer = $this->galerie_photo->userIsPhotographer($this->getUser());
    $this->user=$this->getUser();
    // User auth changes photos we grab
      $this->photos = PhotoTable::getInstance()
        ->getPhotos($this->galerie_photo->getId(), $this->isStudent, $this->hotLinkedPass)->execute();
  
    $response=$this->getResponse();
    $this->getContext()->getConfiguration()->loadHelpers('Thumb');
    $response->addMeta('og:title', $this->galerie_photo->getTitle());
    $response->addMeta('og:type', 'Galery');
    $response->addMeta('og:url', $this->generateUrl(
        'galerie_photo_show',$this->galerie_photo));
    $response->addMeta('og:site_name', 'BDE-UTC : Portail des associations');
    
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
    $event = $galerie_photo->getEvent();
    if (!$event->userIsPhotographer($this->getUser()))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('event/show?id=' . $event->getId());
    }
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
    $event = $galerie_photo->getEvent();
    if (!$event->userIsPhotographer($this->getUser())) {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('event/show?id=' . $event->getId());
    }
    $this->forward404Unless($galerie_photo = Doctrine_Core::getTable('GaleriePhoto')->find(array($request->getParameter('id'))), sprintf('Object galerie_photo does not exist (%s).', $request->getParameter('id')));
    $galerie_photo->delete();

    $this->redirect('event/show?id=' . $event->getId());
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $form_vals = $this->form->getValues();
      $event = EventTable::getInstance()->find($form_vals["event_id"]);
      if ($event->userIsPhotographer($this->getUser())) {
        $galerie_photo = $form->save();
        $this->redirect('galerie/show?id='.$galerie_photo->getId());
      }
    }
  }
}
