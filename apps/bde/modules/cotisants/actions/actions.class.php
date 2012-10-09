<?php

/**
 * cotisants actions.
 *
 * @package    simde
 * @subpackage cotisants
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cotisantsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    
  }
  
  public function executeEdit(sfWebRequest $request)
  {
    if($login = $request->getParameter("login")){
      $ginger = new Ginger();
      $this->cotisant = $ginger->getLogin($login);
      $this->cotisations = $ginger->getCotisations($login);
    }
    $this->formcotisation = new CotisantsCotiserForm();
    $this->formcotisation->setDefault('login', $login);
  }
  
  public function executeCotisation(sfWebRequest $request) {
    if($login = $request->getParameter("login")){
      if($request->getParameter("type") == "Cotiser"){
        $debut = date("Y-m-d");
        
        $yearend = date("Y");
        if(date("m") > 8){
          $yearend++;
        }
        $fin = "$yearend-08-31";
        
        $ginger = new Ginger();
        $ginger->addCotisation($login, $debut, $fin);
      }
      else if($request->getParameter("type") == "Radier"){
        //TODO
      }
    }
    $this->redirect('cotisants/edit?login='.$login);
  }
}
