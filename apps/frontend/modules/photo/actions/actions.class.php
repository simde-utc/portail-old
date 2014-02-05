<?php

/**
 * photo actions.
 *
 * @package    simde
 * @subpackage photo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class photoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->photos = Doctrine_Core::getTable('Photo')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->redirectUnless($this->galerie_photo = $this->getRoute()->getObject(), 'galerie_photo_list');
    if (!$this->galerie_photo->userIsPhotographer($this->getUser())){
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('event/show?id=' . $this->galerie_photo->getEventId());
    }
    $this->form = new PhotoForm();
    $this->form->setDefaults(array('galeriePhoto_id' => $this->galerie_photo->getId(), 'title'=> '', 'author' => $this->getUser()->getGuardUser()->getId()));
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PhotoForm();

    $this->processForm($request, $this->form);
    if($request->getParameter('sf_format') == 'json') {
      if(!$this->form->isValid()) {
        $errors = $this->form->getErrors();
        $this->error = $errors["image"];
      }
    }
    else {
      $this->setTemplate('new');
    }
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($this->photo = Doctrine_Core::getTable('Photo')->find(array($request->getParameter('id'))), sprintf('Object photo does not exist (%s).', $request->getParameter('id')));
    if($this->photo->userIsPhotographer($this->getUser())){
      $this->form = new PhotoEditForm($this->photo);
    }else{
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('galerie/show?id='.$this->photo->getGaleriephotoId());
    }
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($this->photo = Doctrine_Core::getTable('Photo')->find(array($request->getParameter('id'))), sprintf('Object photo does not exist (%s).', $request->getParameter('id')));
    $this->form = new PhotoEditForm($this->photo);

    $this->processEditForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $this->forward404Unless($photo = Doctrine_Core::getTable('Photo')->find(array($request->getParameter('id'))), sprintf('Object photo does not exist (%s).', $request->getParameter('id')));
    $galerie_photo_id = $photo->getGaleriephotoId();
    if($photo->userIsPhotographer($this->getUser())){
      $photo->delete();
    }else{
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
    }
    $this->redirect('galerie/show?id='.$galerie_photo_id);
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $this->photo = $form->save();
      if($request->getParameter('sf_format') != 'json') {
        $this->redirect('galerie/show?id='.$this->photo->getGaleriephotoId().'&photo='.$this->photo->getId());

      }
    }
  }

  protected function processEditForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $photo = $form->save();
      $this->redirect('galerie/show?id='.$photo->getGaleriephotoId().'&photo='.$photo->getId());
    }
  }
}
