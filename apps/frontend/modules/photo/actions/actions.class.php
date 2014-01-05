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

  public function executeShow(sfWebRequest $request)
  {
    $this->photo = $this->getRoute()->getObject();
    $response = $this->getResponse();
    $response->addMeta('og:title', GaleriePhotoTable::getInstance()->find($this->photo->getGaleriephotoId())->getTitle());
    $response->addMeta('og:type', 'Galerie');
    sfProjectConfiguration::getActive()->loadHelpers(array('Asset', 'Thumb'));
    
    // Get the file hash, crop it, use it as a pass to see the photo without being logged in.
    $this->passCode = $this->photo->getPass();
    $this->providedPass = $request->extractParameters(array('pass'=>'pass'))['pass'];
    
    if ($this->getUser()->isAuthenticated() ||
        $this->providedPass == $this->passCode ||
        $this->photo->getIsPublic()==1){

      $response->addMeta('og:photo', doThumb($this->photo->getImage(), 'galeries', array(
          'width' => 2048,
          'height' => 2048),
        'scale'
      ));

      $response->addMeta('og:url',  $this->generateUrl('photo_show',$this->photo,true));
      $response->addMeta('og:site_name', 'BDE-UTC : Portail des associations');
      $this->author = $this->photo->getUser();
      $this->galerie = $this->photo->getGaleriePhoto()->getTitle();
      if ($this->getUser()->isAuthenticated()  || $this->photo->getIsPublic()==1){
        $this->nextPict=PhotoTable::getInstance()->getNextPhoto($this->photo)->execute();
        $this->prevPict=PhotoTable::getInstance()->getPreviousPhoto($this->photo)->execute();
      }
    }else{
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit de voir cette photo. Veuillez vous connecter.');
      $this->redirect('event/show?id=' . $this->photo->getGaleriePhoto()->getEventId());
    }
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->redirectUnless($galerie_photo = $this->getRoute()->getObject(), 'galerie_photo_list');
    if (!$this->getUser()->isAuthenticated()
      || !$this->getUser()->getGuardUser()->hasAccess($galerie_photo->getEvent()->getAsso()->getLogin(), 0x200)
    ) {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('event/show?id=' . $galerie_photo->getEventId());
    }
    $this->form = new PhotoForm();
    $this->form->setDefaults(array('galeriePhoto_id' => $this->getRoute()->getObject()->getId(), 'title'=> NULL, 'author' => $this->getUser()->getGuardUser()->getId(),'is_public' => '0'));
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
    $this->forward404Unless($photo = Doctrine_Core::getTable('Photo')->find(array($request->getParameter('id'))), sprintf('Object photo does not exist (%s).', $request->getParameter('id')));
    $this->form = new PhotoForm($photo);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($photo = Doctrine_Core::getTable('Photo')->find(array($request->getParameter('id'))), sprintf('Object photo does not exist (%s).', $request->getParameter('id')));
    $this->form = new PhotoForm($photo);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($photo = Doctrine_Core::getTable('Photo')->find(array($request->getParameter('id'))), sprintf('Object photo does not exist (%s).', $request->getParameter('id')));
    $galerie_photo_id = $photo->getGaleriePhotoId();
    $photo->delete();

    $this->redirect('galerie/show?id=', $galerie_photo_id);
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $photo = $form->save();

      if($request->getParameter('sf_format') != 'json') {
        $this->redirect('photo/show?id='.$photo->getId());
      }
    }
  }
}
