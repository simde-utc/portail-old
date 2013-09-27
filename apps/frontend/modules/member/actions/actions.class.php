<?php

/**
 * member actions.
 *
 * @package    simde
 * @subpackage member
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class memberActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->asso_members = Doctrine_Core::getTable('AssoMember')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AssoMemberForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AssoMemberForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($this->asso_member = Doctrine_Core::getTable('AssoMember')->find(array($request->getParameter('id'))), sprintf('Object asso_member does not exist (%s).', $request->getParameter('id')));
    if(!$this->getUser()->isAuthenticated() || !$this->getUser()->getGuardUser()->hasAccess($this->asso_member->getAsso()->getLogin(), 0x02))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login='.$this->asso_member->getAsso()->getLogin());
    }
    $this->form = new AssoMemberEditForm($this->asso_member);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($asso_member = Doctrine_Core::getTable('AssoMember')->find(array($request->getParameter('id'))), sprintf('Object asso_member does not exist (%s).', $request->getParameter('id')));
    if(!$this->getUser()->isAuthenticated() || !$this->getUser()->getGuardUser()->hasAccess($asso_member->getAsso()->getLogin(), 0x02))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login='.$asso_member->getAsso()->getLogin());
    }
    $this->form = new AssoMemberEditForm($asso_member);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($asso_member = Doctrine_Core::getTable('AssoMember')->find(array($request->getParameter('id'))), sprintf('Object asso_member does not exist (%s).', $request->getParameter('id')));
    $asso = $asso_member->getAsso();
    $asso_member->delete();

    $this->redirect('assos_show',$asso);
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $asso_member = $form->save();
      $this->getUser()->setFlash('success', 'Rôle du membre '.$asso_member->getUser().' modifié.');
      $this->redirect('asso/member?login='.$asso_member->getAsso()->getLogin());
    }
  }
}
