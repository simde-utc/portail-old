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
  }
//  
//    public function executeEdit(sfWebRequest $request)
//  {
//    $this->form = new ProfileForm();
//  }

//  public function executeUpdate(sfWebRequest $request)
//  {
//    //$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
//    //$this->forward404Unless($profile = Doctrine_Core::getTable('profile')->find(array($request->getParameter('id'))), sprintf('Object profile does not exist (%s).', $request->getParameter('id')));
//    //$this->forward404Unless($this->getUser()->getGuardUser()->hasAccess($article->getAsso()->getLogin(),0x04));
//    $this->form = new ProfileForm();
//    $this->processForm($request, $this->form);
//    $this->setTemplate('edit');
//  }
  
  //identité
  public function executeEditIdentite(sfWebRequest $request)
  {
    $this->profile = $this->getRoute()->getObject();
    $this->form = new ProfileFormIdentite($this->profile); 
  }
  
  public function executeUpdateIdentite(sfWebRequest $request)
  {
    $this->forward404Unless($this->profile = Doctrine_Core::getTable('profile')->find(array($request->getParameter('id'))), sprintf('Object article does not exist (%s).', $request->getParameter('id')));
    $this->form = new ProfileFormIdentite($this->profile);   
    $this->processFormIdentite($request, $this->form);
  }
  
  protected function processFormIdentite(sfWebRequest $request, sfForm $form)
  {
    $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
    if ($this->form->isValid())
    {
      $this->form->save();
      $this->redirect('profile_show');
    }
    $this->setTemplate('error');
   // $this->redirect('profile_show');
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
    $this->form = new ProfileFormInfoPerso($this->profile);   
    $this->processFormInfoPerso($request, $this->form);
  }
  
  protected function processFormInfoPerso(sfWebRequest $request, sfForm $form)
  {
    $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
    if ($this->form->isValid())
    {
      $this->form->save();
      $this->redirect('profile_show');
    }
    $this->setTemplate('error');
   // $this->redirect('profile_show');
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
    $this->form = new ProfileFormInfoSupp($this->profile); 
    $this->processFormInfoSupp($request, $this->form);
  }
  
    protected function processFormInfoSupp(sfWebRequest $request, sfForm $form)
  {
    $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
    if ($this->form->isValid())
    {
      $this->form->save();
      $this->redirect('profile_show');
    }
    $this->setTemplate('error');
   // $this->redirect('profile_show');
  }

 //parcour UTC
    public function executeEditParcoursUTC(sfWebRequest $request)
  {
    $this->profile = $this->getRoute()->getObject();
    $this->form = new ProfileFormParcoursUTC($this->profile); 
  }
  
  public function executeUpdateParcoursUTC(sfWebRequest $request)
  {
    $this->form = new ProfileFormParcoursUTC();   
    $this->processFormInfoPerso($request, $this->form);
  }
  
  protected function processFormParcoursUTC(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $form->save();
      $this->redirect('profile_show');
    }
    $this->redirect('profile_show');
  }
  
//    protected function processForm(sfWebRequest $request, sfForm $form)
//  {
//    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
//    if ($form->isValid())
//    {
//      $profile = $form->save();
//      $this->redirect('profile_show');
//    }
//  }

}
