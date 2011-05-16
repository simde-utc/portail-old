<?php

/**
 * eventType actions.
 *
 * @package    simde
 * @subpackage eventType
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eventTypeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->event_types = Doctrine_Core::getTable('eventType')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new eventTypeForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new eventTypeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($event_type = Doctrine_Core::getTable('eventType')->find(array($request->getParameter('id'))), sprintf('Object event_type does not exist (%s).', $request->getParameter('id')));
    $this->form = new eventTypeForm($event_type);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($event_type = Doctrine_Core::getTable('eventType')->find(array($request->getParameter('id'))), sprintf('Object event_type does not exist (%s).', $request->getParameter('id')));
    $this->form = new eventTypeForm($event_type);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($event_type = Doctrine_Core::getTable('eventType')->find(array($request->getParameter('id'))), sprintf('Object event_type does not exist (%s).', $request->getParameter('id')));
    $event_type->delete();

    $this->redirect('eventType/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $event_type = $form->save();

      $this->redirect('eventType/edit?id='.$event_type->getId());
    }
  }
}
