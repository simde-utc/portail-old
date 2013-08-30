<?php

/**
 * uv actions.
 *
 * @package    simde
 * @subpackage uv
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class uvActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->uvs = Doctrine_Core::getTable('uv')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new uvForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new uvForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($uv = Doctrine_Core::getTable('uv')->find(array($request->getParameter('id'))), sprintf('Object uv does not exist (%s).', $request->getParameter('id')));
    $this->form = new uvForm($uv);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($uv = Doctrine_Core::getTable('uv')->find(array($request->getParameter('id'))), sprintf('Object uv does not exist (%s).', $request->getParameter('id')));
    $this->form = new uvForm($uv);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($uv = Doctrine_Core::getTable('uv')->find(array($request->getParameter('id'))), sprintf('Object uv does not exist (%s).', $request->getParameter('id')));
    $uv->delete();

    $this->redirect('uv/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $uv = $form->save();

      $this->redirect('uv/edit?id='.$uv->getId());
    }
  }
}
