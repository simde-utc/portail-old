<?php

/**
 * reservation actions.
 *
 * @package    simde
 * @subpackage reservation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reservationActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
	 $this->idSalle = $request->getUrlParameter("id", 0);  
  	
    // Chercher les reservations dans la bdd
    //$this->reservation = ReservationTable::getInstance()->getAllReservation()->execute();
  }
  
  public function executeList(sfWebRequest $request)
  {
  		$this->reservation = ReservationTable::getInstance()->getReservationBySalle()->execute();
  }
  
}
