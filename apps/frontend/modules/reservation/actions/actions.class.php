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
  }
  
  public function executeList(sfWebRequest $request)
  {
	$this->reservations = ReservationTable::getInstance()->getAllReservation()->execute();
  	//$this->reservations = ReservationTable::getInstance()->getReservationBySalle()->execute();
  }

  public function executeListBySalle(sfWebRequest $request)
  {
	$this->idSalle = $request->getUrlParameter("id", 0); 
  	$this->reservation = ReservationTable::getInstance()->getReservationBySalle($this->idSalle)->execute();
  }
  
}
