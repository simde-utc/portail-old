<?php

/**
 * event actions.
 *
 * @package    simde
 * @subpackage event
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eventActions extends sfActions
{
  /*
   * @todo gérer les paramètres d'url start et end !
   * 
   * 
   */

  public function executeIndex(sfWebRequest $request)
  {
    $this->events = EventTable::getInstance()->getEventsList()->execute();
    $this->setTemplate('list');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->redirectUnless($asso = $this->getRoute()->getObject(), 'assos_list');
    if(!$this->getUser()->isAuthenticated() || !$this->getUser()->getGuardUser()->hasAccess($asso->getLogin(), 0x08))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login='.$asso->getLogin());
    }
    $this->form = new EventForm();
    $this->form->setDefault('asso_id', $this->getRoute()->getObject()->getId());
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EventForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($event = $this->getRoute()->getObject());
    if(!$this->getUser()->isAuthenticated() || !$this->getUser()->getGuardUser()->hasAccess($event->getAsso()->getLogin(), 0x08))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login='.$event->getAsso()->getLogin());
    }
    $this->form = new EventForm($event);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($event = Doctrine_Core::getTable('event')->find(array($request->getParameter('id'))), sprintf('Object event does not exist (%s).', $request->getParameter('id')));
    if(!$this->getUser()->isAuthenticated() || !$this->getUser()->getGuardUser()->hasAccess($event->getAsso()->getLogin(), 0x08))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login='.$event->getAsso()->getLogin());
    }
    $this->form = new EventForm($event);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($event = Doctrine_Core::getTable('event')->find(array($request->getParameter('id'))), sprintf('Object event does not exist (%s).', $request->getParameter('id')));
    if(!$this->getUser()->isAuthenticated() || !$this->getUser()->getGuardUser()->hasAccess($event->getAsso()->getLogin(), 0x08))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login='.$event->getAsso()->getLogin());
    }
    $event->delete();
    $this->forward('event','index');
  }

  /**
   * Liste des event
   * On affiche la liste des events de l'asso spécifié
   *
   * @param sfRequest $request A request object
   */
  public function executeList(sfWebRequest $request)
  {
    try {
      $this->asso = $this->getRoute()->getObject();
    } catch(Exception $e) {
      $this->forward('event', 'index');
    }

    $this->events = EventTable::getInstance()->getEventsList($this->asso->getPrimaryKey())->execute();
  }

  public function executeCalendar(sfWebRequest $request)
  {
    
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->event = $this->getRoute()->getObject();
    
    $response = $this->getResponse();
    $response->addMeta('og:title', $this->event->getName());
    $response->addMeta('og:type', 'Event');
    sfProjectConfiguration::getActive()->loadHelpers(array('Asset', 'Thumb'));
    $response->addMeta('og:image', doThumb($this->event->getAffiche(), 'events', array(
        'width' => 150,
        'height' => 150),
      'scale'
    ));
    $response->addMeta('og:url', $this->generateUrl('event_show',$this->event,true));
    $response->addMeta('og:site_name', 'BDE-UTC : Portail des associations');

    $this->participants = EventMemberTable::getInstance()->getParticipants($this->event)->execute();
    $this->isPhotographer = $this->event->userIsPhotographer($this->getUser());

    if($this->getUser()->isAuthenticated()){
      $r = EventMemberTable::getInstance()->getEventMember($this->event->getId(), $this->getUser()->getGuardUser()->getId())->execute();
      $this->jeparticipe = false;
      if($r->count() > 0){
        $this->jeparticipe = true;
      }
    }

    $this->galeries = $this->event->getGaleries()->execute();
   }
  
  public function executeRegister(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $this->forward404Unless($event = EventTable::getInstance()->find(array($request->getParameter('id'))), sprintf('Object event does not exist (%s).', $request->getParameter('id')));
    
    if(!$this->getUser()->isAuthenticated()){
      $this->getUser()->setFlash('error', 'Vous devez vous connecter afin d\'effectuer cette action.');
      $this->redirect('event/show?id='.$event->getId());
    }
    
    $em = new EventMember();
    $em->setUser($this->getUser()->getGuardUser());
    $em->setEvent($event);
    $em->save();

    $this->redirect('event/show?id='.$em->getEventId());
  }

public function executeUnregister(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $this->forward404Unless($event = EventTable::getInstance()->find(array($request->getParameter('id'))), sprintf('Object event does not exist (%s).', $request->getParameter('id')));
    if(!$this->getUser()->isAuthenticated())
    {
      $this->getUser()->setFlash('error', 'Vous devez vous connecter afin d\'effectuer cette action.');
      $this->redirect('event/show?id='.$event->getId());
    }
    $em = EventMemberTable::getInstance()->getEventMember($event->getId(), $this->getUser()->getGuardUser()->getId())->execute();
    $em->delete();

    $this->redirect('event/show?id='.$event->getId());
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if($form->isValid())
    {
      $event = $form->save();

      $this->redirect('event/show?id='.$event->getId());
    }
  }
}
