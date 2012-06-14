<?php

/**
 * gesmail actions.
 *
 * @package    simde
 * @subpackage gesmail
 * @author     Arthur Puyou
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gesmailActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    // Droits d'accès
    $asso = AssoTable::getInstance()->getOneByLogin($request->getParameter('login'))->select('q.id, q.login')->fetchOne();
    if(!$this->getUser()->isAuthenticated() || !$this->getUser()->getGuardUser()->hasAccess($asso->getLogin(), 0x80))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login='.$asso->getLogin());
    }
    
    // Récupération de l'asso sur laquelle on est
    $gesmail = new Gesmail($asso);
    $box = $request->getParameter('box');
    $this->boxes = $gesmail->getBoxes();
    $this->asso = $asso;
    $this->box = $gesmail->getBox($box);
    
    if(!$this->box->type && !empty($box))
      $this->redirect('gesmail', array('login' => $asso->getLogin()));
    
    $this->adr = $this->box->getName();
  }
  
  public function executeCreate(sfWebRequest $request)
  {
    $asso = AssoTable::getInstance()->getOneByLogin($request->getParameter('login'))->select('q.id, q.login')->fetchOne();
    if(!$this->getUser()->isAuthenticated() || !$this->getUser()->getGuardUser()->hasAccess($asso->getLogin(), 0x80))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login='.$asso->getLogin());
    }
    
    $gesmail = new Gesmail($asso);
    $this->boxes = $gesmail->getBoxes();
    $this->asso = $asso;
    $this->form = new GesmailCreateForm();
  }
  
    
  public function executeDocreate(sfWebRequest $request)
  {
    $asso = AssoTable::getInstance()->getOneByLogin($request->getParameter('login'))->select('q.id, q.login')->fetchOne();
    if(!$this->getUser()->isAuthenticated() || !$this->getUser()->getGuardUser()->hasAccess($asso->getLogin(), 0x80))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login='.$asso->getLogin());
    }
    
    $gesmail = new Gesmail($asso);
    $mail = $request->getParameter('mail');
    $type = $request->getParameter('type');
    $ret = $gesmail->createBox($mail, $type);
    
    switch($ret){
      case 0:
        if($type == 'ml')
          $this->getUser()->setFlash('success', "Votre mailing-liste est en cours de création. Cette opération peut durer jusqu'à 5 minutes et vous recevrez un e-mail sur l'adresse de l'assos une fois la liste créée.");
        else
          $this->getUser()->setFlash('success', "Votre adresse a été ajoutée.");
        
        $this->redirect('gesmail_box', array('login' => $asso->getLogin(), 'box' => $mail));
      break;
      case 1:
        $this->getUser()->setFlash('warning', "Cette adresse existe déjà.");
        $this->redirect('gesmail_box', array('login' => $asso->getLogin(), 'box' => $mail));
      break;
      case 2:
        $this->getUser()->setFlash('error', "L'adresse doit être composée exclusivement de caractères alphanumériques minuscules");
      break;
    }
    
    $this->redirect('gesmail_create', array('login' => $asso->getLogin()));
  }
  
  public function executeDelete(sfWebRequest $request){
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $asso = AssoTable::getInstance()->getOneByLogin($request->getParameter('login'))->select('q.id, q.login')->fetchOne();
    if(!$this->getUser()->isAuthenticated() || !$this->getUser()->getGuardUser()->hasAccess($asso->getLogin(), 0x80))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login='.$asso->getLogin());
    }
    
    // Récupération de l'asso sur laquelle on est
    $gesmail = new Gesmail($asso);
    $box = $gesmail->getBoxByID($request->getParameter('box'));
    $box->deleteDest($request->getParameter('email'));
        
    $this->redirect('gesmail_box', array('box' => $box->extension , 'login' => $asso->getLogin()));
  }
  
  public function executeAdd(sfWebRequest $request){
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $asso = AssoTable::getInstance()->getOneByLogin($request->getParameter('login'))->select('q.id, q.login')->fetchOne();
    if(!$this->getUser()->isAuthenticated() || !$this->getUser()->getGuardUser()->hasAccess($asso->getLogin(), 0x80))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login='.$asso->getLogin());
    }
    
    // Récupération de l'asso sur laquelle on est
    $gesmail = new Gesmail($asso);
    $box = $gesmail->getBoxByID($request->getParameter('box'));
    $ret = $box->addDest($request->getParameter('email'));
    
    if($ret == 1)
      $this->getUser()->setFlash('error', "L'adresse saisie est incorrecte.");
    elseif($ret == 2)
      $this->getUser()->setFlash('error', "Il est impossible d'ajouter une adresse à elle-même (regarde les options ;)).");
    elseif($ret == 3)
      $this->getUser()->setFlash('warning', "Cette adresse est déjà présente dans la liste.");

    if(empty($box->extension))
      $this->redirect('gesmail', array('login' => $asso->getLogin()));
    else
      $this->redirect('gesmail_box', array('box' => $box->extension, 'login' => $asso->getLogin()));
  }
  
  
}
