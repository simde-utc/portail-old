<?php

class reservationComponents extends sfComponents
{

  public function executeCalendarMenu()
  {
  }
  
  public function executeListeSalles()
  {    
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
				array_push($this->sallesUser, $salle);
		    }
	}
  }
  
  public function executeFormNew(sfWebRequest $request)
  {
	$this->idSalle = $request->getUrlParameter("id", -1);
	
	$this->userIdentified = false;
	
	if ($this->getUser()->isAuthenticated()) // besoin de controler si il y a un numéro de salles
	{
	
		$this->userIdentified= true;
		      
		$this->UserID = $this->getUser()->getGuardUser()->getId();
				
		// création du tableua à passer au constructeur du formulaire de réservation
		$values = array('UserID'=> $this->UserID,'idSalle'=> $this->idSalle);
	    
		$this->form = new ReservationForm(array(),$values);
		
		// TO DO : Voir si la salle appartient au BDE ou non et en fonction donner possiblité de rentrer une asso ou non.
		$PoleId= SalleTable::getInstance()->getSalleById($this->idSalle)->execute()[0]->getIdPole();
		if($PoleId==1){
		    $this->form->getWidget('id_asso')->setOption('add_empty',true);
		}
		
		// valeur par défaut pour les champs cachés.
		$this->form->setDefault('id_salle', $this->idSalle);
		$this->form->setDefault('id_user_reserve', $this->getUser()->getGuardUser()->getId());
		$this->form->setDefault('estvalide', 0); // A VOIR si 2 semaines avant ou pas
				
		$this->ok = false;
		$this->afficherErreur= false;
  

  	      
	}
	 
  }

}
