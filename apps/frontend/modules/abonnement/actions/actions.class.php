<?php

/**
 * abonnement actions.
 *
 * @package    simde
 * @subpackage abonnement
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class abonnementActions extends sfActions
{

  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
    
  }
  
  public function executeShow(sfWebRequest $request){
    $this->text='hello world';
    $this->abonnements = AbonnementTable::getInstance()->getMyAsso($this->getUser()->getGuardUser()->getId())->execute();
   
  }


}
