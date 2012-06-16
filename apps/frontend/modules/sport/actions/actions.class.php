<?php

/**
 * sport actions.
 *
 * @package    simde
 * @subpackage sport
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sportActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->sports = Doctrine_Core::getTable('Sport')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SportForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SportForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($sport = Doctrine_Core::getTable('Sport')->find(array($request->getParameter('id'))), sprintf('Object sport does not exist (%s).', $request->getParameter('id')));
    $this->form = new SportForm($sport);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($sport = Doctrine_Core::getTable('Sport')->find(array($request->getParameter('id'))), sprintf('Object sport does not exist (%s).', $request->getParameter('id')));
    $this->form = new SportForm($sport);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($sport = Doctrine_Core::getTable('Sport')->find(array($request->getParameter('id'))), sprintf('Object sport does not exist (%s).', $request->getParameter('id')));
    $sport->delete();

    $this->redirect('sport/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $sport = $form->save();

      $this->redirect('sport/edit?id='.$sport->getId());
    }
  }
  
  public function executeAdd(sfWebRequest $request)
  {
      $this->forward404unless($request->isXmlHttpRequest());
      $number = intval($request->getParameter("num"));

      $this->form = new SportForm();

      $this->form->addNewFields($number);

      return $this->renderPartial('addNew',array('form' => $this->form, 'number' => $number));
  }
}
