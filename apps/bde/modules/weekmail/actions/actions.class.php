<?php

/**
 * weekmail actions.
 *
 * @package    simde
 * @subpackage weekmail
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class weekmailActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->articles = ArticleTable::getInstance()->getArticlesForWeekmail()->execute();
    $this->weekmails = WeekmailTable::getInstance()->getLast()->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new WeekmailForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new WeekmailForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($weekmail = Doctrine_Core::getTable('Weekmail')->find(array($request->getParameter('id'))), sprintf('Object weekmail does not exist (%s).', $request->getParameter('id')));
    $this->form = new WeekmailForm($weekmail);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($weekmail = Doctrine_Core::getTable('Weekmail')->find(array($request->getParameter('id'))), sprintf('Object weekmail does not exist (%s).', $request->getParameter('id')));
    $this->form = new WeekmailForm($weekmail);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($weekmail = Doctrine_Core::getTable('Weekmail')->find(array($request->getParameter('id'))), sprintf('Object weekmail does not exist (%s).', $request->getParameter('id')));
    $weekmail->delete();

    $this->redirect('weekmail/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $weekmail = $form->save();

      $this->redirect('weekmail/edit?id='.$weekmail->getId());
    }
  }
}
