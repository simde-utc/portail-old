<?php

/**
 * gesmail actions.
 *
 * @package    simde
 * @subpackage gesmail
 * @author     Your name here
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
    $gesmail = new Gesmail();
    $gesmail->setAsso($asso);
    $this->boxes = $gesmail->getBoxes();
    
    $this->adr = -1;
    if($request->getParameter('box'))
      $this->adr = $request->getParameter ('box');
    
    $this->asso = $asso;
    
    $this->destinataires = $gesmail->getBoxContents($this->adr);
  }
  
  public function executeEdit(sfWebRequest $request)
  {
    
  }
}
