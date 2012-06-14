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
    $this->boxes = $gesmail->getBoxes();
    $this->asso = $asso;
    $this->box = $gesmail->getBox($request->getParameter('box'));
    $this->adr = $this->box->getName();
  }
  
  public function executeEdit(sfWebRequest $request)
  {
    
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
    $box = $gesmail->getBox($request->getParameter('box'));
    $box->deleteDest($request->getParameter('email'));
        
    $this->redirect('gesmail_box', array('box' => $box->extension , 'login' => $asso->getLogin()));
  }
}
