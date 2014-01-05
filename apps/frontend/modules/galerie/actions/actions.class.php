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
    $this->redirectUnless($event = $this->getRoute()->getObject(), 'event_list');
    if (!$this->getUser()->isAuthenticated()
      || !$this->getUser()->getGuardUser()->hasAccess($event->getAsso()->getLogin(), 0x200)
    ) {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('event/show?id=' . $event->getId());
    }
    $this->form = new GaleriePhotoForm();
    $this->form->setDefault('event_id', $this->getRoute()->getObject()->getId());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->galerie_photo = Doctrine_Core::getTable('GaleriePhoto')->find(array($request->getParameter('id')));
    if ($this->getUser()->isAuthenticated()) {
      $this->photos = PhotoTable::getInstance()->getPhotosList($this->galerie_photo->getId())->execute();
    }
    else{
      $this->photos = PhotoTable::getInstance()->getPhotosPublicList($this->galerie_photo->getId())->execute();
    }
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
    if (!$this->getUser()->isAuthenticated()
      || !$this->getUser()->getGuardUser()->hasAccess($event->getAsso()->getLogin(), 0x200)
    ) {
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
    if (!$this->getUser()->isAuthenticated()
      || !$this->getUser()->getGuardUser()->hasAccess($event->getAsso()->getLogin(), 0x200)
    ) {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('event/show?id=' . $event->getId());
    }
    $this->forward404Unless($galerie_photo = Doctrine_Core::getTable('GaleriePhoto')->find(array($request->getParameter('id'))), sprintf('Object galerie_photo does not exist (%s).', $request->getParameter('id')));
    $photos = PhotoTable::getInstance()->getPhotosList($galerie_photo->getId())->execute();
    foreach ($photos as $photo) {
      $photo->delete();
    }

    $galerie_photo->delete();

    $this->redirect('galerie/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $form_vals = $this->form->getValues();
      $event = EventTable::getInstance()->find($form_vals["event_id"]);
      if ($this->getUser()->isAuthenticated()
       && $this->getUser()->getGuardUser()->hasAccess($event->getAsso()->getLogin(), 0x200)
      ) {
        $galerie_photo = $form->save();
      }

      $this->redirect('galerie/edit?id='.$galerie_photo->getId());
    }
  }
}
