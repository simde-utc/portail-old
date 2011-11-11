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
   * @todo gérer les parametres d'url start et end ! 
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
    $this->form = new EventForm();
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
    $this->forward404Unless($event = Doctrine_Core::getTable('event')->find(array($request->getParameter('id'))), sprintf('Object event does not exist (%s).', $request->getParameter('id')));
    $this->form = new EventForm($event);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($event = Doctrine_Core::getTable('event')->find(array($request->getParameter('id'))), sprintf('Object event does not exist (%s).', $request->getParameter('id')));
    $this->form = new EventForm($event);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($event = Doctrine_Core::getTable('event')->find(array($request->getParameter('id'))), sprintf('Object event does not exist (%s).', $request->getParameter('id')));
    $event->delete();

    $this->redirect('event/index');
  }

  /**
   * Liste des event
   * On affiche la liste des events de l'asso specifié
   *
   * @param sfRequest $request A request object
   */
  public function executeList(sfWebRequest $request)
  {
    try {
      $this->asso = $this->getRoute()->getObject();
    }
    catch (Exception $e) {
      $this->forward('event','index');
    }

    $this->events = EventTable::getInstance()->getEventsList($this->asso->getPrimaryKey());
  }

  public function executeCalendar(sfWebRequest $request)
  {
    
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->event = $this->getRoute()->getObject();
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $event = $form->save();

      $this->redirect('event/edit?id='.$event->getId());
    }
  }
}
