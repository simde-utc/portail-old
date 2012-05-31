<?php

/**
 * image actions.
 *
 * @package    simde
 * @subpackage image
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class imageActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->images = Doctrine_Core::getTable('image')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->image = Doctrine_Core::getTable('image')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->image);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new imageForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new imageForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($image = Doctrine_Core::getTable('image')->find(array($request->getParameter('id'))), sprintf('Object image does not exist (%s).', $request->getParameter('id')));
    $this->form = new imageForm($image);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($image = Doctrine_Core::getTable('image')->find(array($request->getParameter('id'))), sprintf('Object image does not exist (%s).', $request->getParameter('id')));
    $this->form = new imageForm($image);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($image = Doctrine_Core::getTable('image')->find(array($request->getParameter('id'))), sprintf('Object image does not exist (%s).', $request->getParameter('id')));
    $image->delete();

    $this->redirect('image/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $image = $form->save();

      $this->redirect('image/edit?id='.$image->getId());
    }
  }
}
