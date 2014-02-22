<?php

/**
 * profile actions.
 *
 * @package    simde
 * @subpackage profile
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class profileActions extends sfActions
{
  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }

  public function executeShow(sfWebRequest $request)
  {
    if (!$this->getUser()->isAuthenticated())
      $this->redirect("homepage");
    $this->user = $this->getRoute()->getObject();
    
    $this->profile = ProfileTable::getInstance()->getProfileForUser($this->user->getId())->fetchOne();
    $this->semestres = UserSemestreTable::getInstance()->getAllByProfile($this->profile)->execute();

  }

  //identité
  public function executeEditIdentite(sfWebRequest $request)
  {
    $this->profile = $this->getRoute()->getObject();
    $this->form = new ProfileFormIdentite($this->profile);
  }

  public function executeUpdateIdentite(sfWebRequest $request)
  {
    $this->forward404Unless($this->profile = Doctrine_Core::getTable('profile')->find(array($request->getParameter('id'))), sprintf('Object article does not exist (%s).', $request->getParameter('id')));
    $this->profileUser = ProfileTable::getInstance()->getProfileForUser($this->getUser()->getGuardUser()->getId())->fetchOne();
    if ($this->profileUser->getId() == $this->profile->getId()){
      $this->form = new ProfileFormIdentite($this->profile);
      $this->processFormIdentite($request, $this->form);
    }
  }

  protected function processFormIdentite(sfWebRequest $request, sfForm $form)
  {
    $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
    if ($this->form->isValid()) {
      $this->form->save();
      $this->redirect('profile/show?username=' . $this->getUser()->getUsername());
    }
    $this->setTemplate('error');
  }

  //infoPerso
  public function executeEditInfoPerso(sfWebRequest $request)
  {
    $this->profile = $this->getRoute()->getObject();
    $this->form = new ProfileFormInfoPerso($this->profile);
  }

  public function executeUpdateInfoPerso(sfWebRequest $request)
  {
    $this->forward404Unless($this->profile = Doctrine_Core::getTable('profile')->find(array($request->getParameter('id'))), sprintf('Object article does not exist (%s).', $request->getParameter('id')));
    $this->profileUser = ProfileTable::getInstance()->getProfileForUser($this->getUser()->getGuardUser()->getId())->fetchOne();
    if ($this->profileUser->getId() == $this->profile->getId()){
      $this->form = new ProfileFormInfoPerso($this->profile);
      $this->processFormInfoPerso($request, $this->form);
    }
  }

  protected function processFormInfoPerso(sfWebRequest $request, sfForm $form)
  {
    $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
    if ($this->form->isValid()) {
      $this->form->save();
      $this->redirect('profile/show?username=' . $this->getUser()->getUsername());
    }
    $this->setTemplate('error');
  }

  //infoSupp
  public function executeEditInfoSupp(sfWebRequest $request)
  {
    $this->profile = $this->getRoute()->getObject();
    $this->form = new ProfileFormInfoSupp($this->profile);
  }

  public function executeUpdateInfoSupp(sfWebRequest $request)
  {
    $this->forward404Unless($this->profile = Doctrine_Core::getTable('profile')->find(array($request->getParameter('id'))), sprintf('Object article does not exist (%s).', $request->getParameter('id')));
    $this->profileUser = ProfileTable::getInstance()->getProfileForUser($this->getUser()->getGuardUser()->getId())->fetchOne();
    if ($this->profileUser->getId() == $this->profile->getId()){
      $this->form = new ProfileFormInfoSupp($this->profile);
      $this->processFormInfoSupp($request, $this->form);
    }
  }

  protected function processFormInfoSupp(sfWebRequest $request, sfForm $form)
  {
    $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
    if ($this->form->isValid()) {
      $this->form->save();
      $this->redirect('profile/show?username=' . $this->getUser()->getUsername());
    }
    $this->setTemplate('error');
  }
}
