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
		
		// on ne récupère que les noms d'assos correspondant aux pôles 
		// pourquoi prend le login et pas le nom ?
		$this->query = AssoTable::getInstance()->getMyAssosName($UserID,$this->idSalle);
		//var_dump($this->query);
		
		// création du tableua à passer au constructeur du formulaire de réservation
		$values = array('UserID'=> $UserID,'idSalle'=> $this->idSalle, 'query'=>$this->query);
	    
		$this->form = new ReservationForm(array(),$values);
		
		// TO DO
		//$this->form->getWidget('id_asso')->setAttribute('can_be_empty',true);
		
		// valeur par défaut pour les champs cachés.
		$this->form->setDefault('id_salle', $this->idSalle);
		$this->form->setDefault('id_user_reserve', $this->getUser()->getGuardUser()->getId());
		$this->form->setDefault('estvalide', 0); // A VOIR si 2 semaines avant ou pas
		
		$this->ok = false;
		$this->afficherErreur= false;
  
  		if ($request->isMethod('post'))
  		{
  			$this->form->bind($request->getParameter($this->form->getName()));
			//var_dump($this->form);
			if ($this->form->isValid())
			{
				$this->reservation=$this->form->save(); // Save into database 
				$this->ok=true;
			}
			else
			{
			      $this->afficherErreur= true;
			}
		}
  	      
	}
	 
  }
  
  public function executeList(sfWebRequest $request)
  {
	$this->user = $this->getUser()->getGuardUser();
	if($this->getUser()->isAuthenticated())
	{
		//BDE toujours dans les poles de l'utilisateur
		$this->polesUser = array("1");

		$this->assosUser = AssoTable::getInstance()->getMyAssos($this->getUser()->getGuardUser()->getId())->execute();
		if($this->assosUser)
		{
			foreach($this->assosUser as $asso)
			{
				$pole = PoleTable::getInstance()->getOneById($asso->getPoleId());
				if(!in_array($pole->getId(), $this->polesUser))
					array_push($this->polesUser, $pole->getId());
			}
		}
		$this->sallesUser = array();
		    foreach($this->polesUser as $pole)
		    {
		   	 $salles = SalleTable::getInstance()->getSalleByPole($pole)->execute();
			 foreach($salles as $salle)
				array_push($this->sallesUser, $salle->getId());
		    }

		$this->reservations = array();	
		foreach($this->sallesUser as $salle)
		{	
			$resa = ReservationTable::getInstance()->getReservationBySalle($salle)->execute();
			foreach($resa as $res)
				array_push($this->reservations, $res);
		}
	}
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
