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
	
	$this->userIdentified = false;
	
	if ($this->getUser()->isAuthenticated()) // besoin de controler si il y a un numéro de salles
	{
	
		$this->userIdentified= true;
		      
		$UserID = $this->getUser()->getGuardUser()->getId();
		     
		$values = array('UserID'=> $UserID,'idSalle'=> $this->idSalle);
	    
		$this->form = new ResaForm(array(),$values);
		
		$this->ok = false;
  
  		if ($request->isMethod('post'))
  		{
  			$this->form->bind($request->getParameter($this->form->getName()));
		
			if ($this->form->isValid())
			{
				$this->idSalle=$request->getPostParameter('resa-form[id_salle]');
	
				$reservation = new Reservation();
				
				$reservation->setIdUserReserve($this->getUser()->getGuardUser()->getId());
				$reservation->setIdAsso($request->getPostParameter('resa-form[id_asso]'));
				$reservation->setIdSalle($request->getPostParameter('resa-form[id_salle]'));
				$reservation->setDate(sprintf("%02d",$request->getPostParameter('resa-form[date][year]'))."-".sprintf("%02d",$request->getPostParameter('resa-form[date][month]'))."-".sprintf("%02d",$request->getPostParameter('resa-form[date][day]')));
				$reservation->setHeuredebut(sprintf("%02d",$request->getPostParameter('resa-form[heuredebut][hour]')).":".sprintf( "%02d", $request->getPostParameter('resa-form[heuredebut][minute]')).":00");
				$reservation->setHeurefin(sprintf("%02d",$request->getPostParameter('resa-form[heurefin][hour]')).":".sprintf( "%02d", $request->getPostParameter('resa-form[heurefin][minute]')).":00");
				$reservation->setActivite($request->getPostParameter('resa-form[activite]'));
				$reservation->setEstValide(1);

				$reservation->save(); // Save into database 
				$this->ok=true;
			}
  		}
  	      
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
  
  public function executeProcessFormResa(sfWebRequest $request /*, sfForm $form*/)
  {
	    $this->idSalle=$request->getPostParameter('resa-form[id_salle]');
	    
	    $reservation = new Reservation();
	    $reservation->setIdUserReserve($this->getUser()->getGuardUser()->getId());
	    $reservation->setIdAsso($request->getPostParameter('resa-form[id_asso]'));
	    $reservation->setIdSalle($request->getPostParameter('resa-form[id_salle]'));
	    $reservation->setDate(sprintf("%02d",$request->getPostParameter('resa-form[date][year]'))."-".sprintf("%02d",$request->getPostParameter('resa-form[date][month]'))."-".sprintf("%02d",$request->getPostParameter('resa-form[date][day]')));
	    $reservation->setHeuredebut(sprintf("%02d",$request->getPostParameter('resa-form[heuredebut][hour]')).":".sprintf( "%02d", $request->getPostParameter('resa-form[heuredebut][minute]')).":00");
	    $reservation->setHeurefin(sprintf("%02d",$request->getPostParameter('resa-form[heurefin][hour]')).":".sprintf( "%02d", $request->getPostParameter('resa-form[heurefin][minute]')).":00");
	    $reservation->setActivite("Reunioon");
	    
	    $reservation->save(); // Save into database  

	}


}
