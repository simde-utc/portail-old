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
  		$this->param = "index";
  }
  
  /**
  *	Toute la gestion des salles
  **/
  
  public function executeSalles(sfWebRequest $request)
  {
  		$this->param = "salles";
  		
  		$this->salles = SalleTable::getInstance()->getAllSalles()->execute();
  }
  
  public function executeSallesUpdate(sfWebRequest $request)
  {
  
  		$this->param = "salles";
  		
  		$this->id = $request->getParameter('id',-1);
  		
  		$this->forward404Unless(SalleTable::getInstance()->isSalleExist($this->id));
  
  		$this->salle_modif = SalleTable::getInstance()->getSalleById($this->id)->execute()[0];
		
		$this->form = new SalleForm($this->salle_modif);
  		
  		$this->update = false;
  		
  		if ($request->isMethod('post'))
  		{
  			$this->form->bind($request->getParameter($this->form->getName()));
		
			if ($this->form->isValid())
			{
				$this->salle = $this->form->save();
				$this->update = true;
			}
  		}
  		

  }
  
  public function executeSallesNew(sfWebRequest $request)
  {
  		$this->param = "salles";
  		
  		$this->form = new SalleForm();
  
  		if ($request->isMethod('post'))
  		{
  			$this->form->bind($request->getParameter($this->form->getName()));
		
			if ($this->form->isValid())
			{
				$this->salle = $this->form->save();
			}
  		}
   
  }
  
  public function executeSallesDelete(sfWebRequest $request)
  {
  		$this->param = "salles";
  		
  		$this->id = $request->getParameter('id',-1);
  		
  		$this->forward404Unless(SalleTable::getInstance()->isSalleExist($this->id));
  		
  		$this->salle = SalleTable::getInstance()->getSalleById($this->id)->execute()[0];
  		
  		$this->suppr = false;
  		
  		if ($request->isMethod('post'))
  		{
  			SalleTable::getInstance()->deleteSalle($this->id)->execute();
  			
  			$this->suppr = true;
  		}

  }
  
  /**
  *	Toute les reservations à valider
  */
  
  public function executeValidation(sfWebRequest $request)
  {
   	$this->param = "validation";
   	
   	$this->id = $request->getParameter('id',-1);
   	
   	// Affichage liste non validé
   	if ($this->id == -1)
   	{
   		$this->reservations = ReservationTable::getInstance()->getReservationNoValide()->execute();
   	}
   	else
   	{
   		$this->forward404Unless(ReservationTable::getInstance()->isReservationNoValidExist($this->id));
   		
   		$this->reservation = ReservationTable::getInstance()->getReservationById($this->id)->execute()[0];
   	}	
  }
  
  public function executeValidationValid(sfWebRequest $request)
  {
		if (!$request->isMethod('post'))
  		{
  			$this->forward404Unless(false);
  		}  
  
   	$this->param = "validation";
   	
   	$this->id = $request->getParameter('id',-1);
   	
   	// Erreur si pas d'id
   	if ($this->id == -1)
   	{
   		$this->forward404Unless(false);
   	}
   	else // Tout est OK !
   	{
   		$this->forward404Unless(ReservationTable::getInstance()->isReservationNoValidExist($this->id));
   	
   		$this->reservation = ReservationTable::getInstance()->getReservationById($this->id)->execute()[0];
   		
   		$accepter = $request->getParameter("accepter",false); 
   		$refuser = $request->getParameter("refuser",false);
   		
   		// Si accepter
   		if ($accepter && !$refuser)
   		{
   			$this->valid = "accepter";
   		}
   		// Si refuser
   		else if ($refuser && !$acceter)
   		{
   			$this->valid = "refuser";
   		}
   		else
   		{
   			$this->forward404Unless(false);
   		}
   		
   		/*
   		$this->forward404Unless(ReservationTable::getInstance()->isReservationNoValidExist($this->id));
   		
   		$reservation = ReservationTable::getInstance()->getReservationById($this->id)->execute()[0];
   		$reservation->setEstvalide(true);
   		$reservation->setIdUserValid($this->getUser()->getId());
   		$reservation->save();
   		
   		$mailDestinataire = "anthony.legiret@gmail.com";
   		
   		//->getEmailAddress()
   		// Envoi d'un mail de confirmation
 			$message = $this->getMailer()->compose(
   			array('simde@assos.utc.fr' => 'SiMDE'),
  				 $mailDestinataire,
   			 'Reservation d\'une salle',
   <<<EOF
Bonjour,

Votre signature de charte vient d'être validée, vous êtes donc maintenant président de l'association {$asso->getName()}.

Rendez-vous sur le portail pour mettre à jour sa page ou attribuer des droits à d'autres membres !

L'équipe du SiMDE
EOF
);
			$this->getMailer()->send($message);
			*/
   	}	
  }
  
}
