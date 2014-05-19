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
 /*
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
	 $this->idSalle = $request->getUrlParameter("id", -1);
	 //$this->executeCalendar($request);  
	
	// fct de pole : getOneById($id)
	//$this->pole_name = SalleTable::getInstance()->getPoleOfSalle($this->idSalle)->execute()[0];
	
	$this->userIdentified = false;
	
	if ($this->getUser()->isAuthenticated()) // besoin de controler si il y a un numéro de salles
	{
		      $this->userIdentified= true;
		      
		      $UserID = $this->getUser()->getGuardUser()->getId();
		      
		      $values = array('UserID'=> $UserID,'idSalle'=> $this->idSalle);
	    
		      $this->form = new ResaForm(array(),$values);
	}
	 
  }
  
  public function executeList(sfWebRequest $request)
  {
	$this->reservations = ReservationTable::getInstance()->getAllReservation()->execute();
  }

  public function executeListBySalle(sfWebRequest $request)
  {
	$this->idSalle = $request->getUrlParameter("id"); 
  	$this->reservation = ReservationTable::getInstance()->getReservationBySalle($this->idSalle)->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
	$this->reservation = ReservationTable::getInstance()->getReservationById($request->getUrlParameter("id"))->execute()[0];
  }

  
  public function executeProcessFormResa(sfWebRequest $request)
  {
	
	$this->forward404Unless($request->isMethod('post'));

	$this->idSalle=$request->getPostParameter('test-form[id_salle]');
	
	$reservation = new Reservation();
	$reservation->setIdUserReserve($this->getUser()->getGuardUser()->getId());
	$reservation->setIdAsso($request->getPostParameter('test-form[id_asso]'));
	$reservation->setIdSalle($request->getPostParameter('test-form[id_salle]'));
	$reservation->setDate(sprintf("%02d",$request->getPostParameter('test-form[date][year]'))."-".sprintf("%02d",$request->getPostParameter('test-form[date][month]'))."-".sprintf("%02d",$request->getPostParameter('test-form[date][day]')));
	$reservation->setHeuredebut(sprintf("%02d",$request->getPostParameter('test-form[heuredebut][hour]')).":".sprintf( "%02d", $request->getPostParameter('test-form[heuredebut][minute]')).":00");
	$reservation->setHeurefin(sprintf("%02d",$request->getPostParameter('test-form[heurefin][hour]')).":".sprintf( "%02d", $request->getPostParameter('test-form[heurefin][minute]')).":00");
	
	$reservation->save(); // Save into database  
	
  }
}
