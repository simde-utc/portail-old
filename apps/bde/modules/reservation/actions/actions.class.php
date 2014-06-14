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
  
  public function executeSalle(sfWebRequest $request)
  {
  		$this->param = "salle";
  		
  		$this->salles = SalleTable::getInstance()->getAllSalles()->execute();
  }
  
  public function executeSalleUpdate(sfWebRequest $request)
  {
  
  		$this->param = "salle";
  		
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
  
  public function executeSalleNew(sfWebRequest $request)
  {
  		$this->param = "salle";
  		
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
  
  public function executeSalleDelete(sfWebRequest $request)
  {
  		$this->param = "salle";
  		
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
  *	Toute la gestion des reservations à valider
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
   		
   		$this->commentaire = $request->getParameter("commentaire","");

   		// Si accepter => valide la reservation, ajoute la personne qui a validé, update base
   		if ($accepter && !$refuser)
   		{
   			$this->valider = true;
   			$this->reservation->setEstvalide(true);
   			$this->reservation->setIdUserValid($this->getUser()->getGuardUser()->getId());
   			$this->reservation->save();
   			
   			$this->mail = $this->sendMailValid(
							$this->reservation,
							$this->commentaire,
							$this->valider
							);
   			
   		}
   		// Si refuser => on supprime la reservation de la base
   		else if ($refuser && !$accepter)
   		{
   			$this->valider = false;
   			
   			$this->mail = $this->sendMailValid(
							$this->reservation,
							$this->commentaire,
							$this->valider
							);
   			
   			$this->reservation->delete();
   		}
   		else
   		{
   			$this->forward404Unless(false);
   		}
   		
   	}	
  }
  
  // Gestion des reservations dans son ensemble
  public function executeGestion(sfWebRequest $request)
  {
  		$this->param = "gestion";
  		
  		$this->poles = PoleTable::getInstance()->getAllWithInfos()->execute();

		$this->pole = $request->getParameter('pole',-1);
  		$this->salle = $request->getParameter('salle',-1);
  		
  		
  }
  
  public function executeGestionEdit(sfWebRequest $request)
  {
  		// AJAX 
  		if (!$request->isXmlHttpRequest())
  		{
  			$this->forward404Unless(false);
  		}
  		
  		// Recupération des paramètres
  		// Tout a été converti en javascript
		// la reservation est modifiée en conséquence
  		
  		$reservation = ReservationTable::getInstance()->getReservationById($request->getParameter('id'))->execute()[0];
  		$reservation->setDate($request->getParameter('date'));
  		$reservation->setHeureDebut($request->getParameter('start'));
  		$reservation->setHeureFin($request->getParameter('end'));
  		$reservation->setAllday(filter_var($request->getParameter('allday'), FILTER_VALIDATE_BOOLEAN));
  		$reservation->save();
  		
  		$this->sendMailModif($reservation,$request->getParameter('comment'));
  		
  }
  
  public function executeGestionId(sfWebRequest $request)
  {
  		$this->param = "gestion";
  
  		$this->id = $request->getParameter('id',-1);
  		
  		$this->forward404Unless($this->id!=-1);
  		
  		$this->forward404Unless(ReservationTable::getInstance()->isReservationExist($this->id));
  		
  		$this->reservation = ReservationTable::getInstance()->getReservationById($this->id)->execute()[0];
  		
  		$this->delete = false;
  		
  		if ($request->isMethod('POST'))
  		{
  			$this->delete = true;
  		
  			$this->mail = $this->sendMailSuppr($this->reservation,$request->getParameter('comment'));
  		
  			$this->reservation->delete();
  		}
  		
  }
  
  /**
  *	Pour le JSON
  *
  */
  public function executeReservations(sfWebRequest $request)
  {
  		// -1 signifie ALL
  		$pole = $request->getParameter('pole',-1);
  		$salle = $request->getParameter('salle',-1);
  
  		// Si j'ai le pole
  		if ($pole != -1)
  		{
  			// Prendre la salle du pole
  			// On ne peut pas se tromper sur la salle, car les salles sont affichées dynamiquement selon le pole séléctionner avant
  			if ($salle != -1)
  			{
  				$this->reservations = ReservationTable::getInstance()->getReservationBySalle($salle)->execute();
  			}
  			// Prendre toutes les salles du pole
  			else
  			{
  				$this->reservations = ReservationTable::getInstance()->getReservationByPole($pole)->execute();
  			}
  		}
  		// Aucun information = On prend tout
  		else
  		{
  			$this->reservations = ReservationTable::getInstance()->getAllReservation()->execute();
  		}
  		
  }
  
  public function executeGetSalleByPole(sfWebRequest $request)
  {
  		// AJAX
  		if (!$request->isXmlHttpRequest())
  		{
  			$this->forward404Unless(false);
  		}
  		
  		$idSalle = intval($request->getParameter('salle')); 
  		
  		$idPole = intval($request->getParameter('pole'));
  		
  		if ($idPole != -1)
  		{
  			$pole = PoleTable::getInstance()->getOneById($idPole);
  		
  			return $this->renderPartial('reservation/selectSalles',array('salles'=>$pole->getSalle(),'id' => $idSalle));
  		}
  		
  		return $this->renderPartial('reservation/selectSalles',array());
  }
  
  /**
  *	Gestion des creneaux Off
  *
  *
  */
  public function executeCreneauoff(sfWebRequest $request)
  {
  		$this->param = "creneauoff";
  		
  		$this->salles = SalleTable::getInstance()->getAllSalles()->execute();
  		
  		$this->formDay = new CreneauDayForm();
  		$this->formHour = new CreneauHourForm();
  		
  		if ($request->isMethod('POST'))
  		{
  		
  			if ($request->getParameter('day'))
  			{
  				// Le bind ne foncionne pas, donc j'ai du faire les conditions à la main
  			
  				$this->errD = array();
  			
				$params = $request->getParameter('CreneauDay');

				$date = date("Y-m-d",strtotime($params['date']));

				if (date("Y-m-d") > $date)
					$this->errD[] = "Impossible d'ajouter une journée Off dans le passé";
					
				if (!isset($params['salles']))
					$this->errD[] = "Aucune salle n'a été séléctionnée";
		
				// Si il n'y a pas d'erreur
				if (count($this->errD) == 0)
				{
					foreach ($params['salles'] as $salle)
	  				{  					
	  					$reservation = new Reservation();
	  					
		  				$reservation->setIdUserReserve($this->getUser()->getGuardUser()->getId());
		  				$reservation->setIdAsso(1); // BDE
		  				$reservation->setDate($date);
		  				$reservation->setHeuredebut('00:00');
		  				$reservation->setHeurefin('00:00');
		  				$reservation->setAllday(true);
		  				$reservation->setActivite('Journée Interdite');
		  				$reservation->setEstvalide(true);
		  				//$reservation->setCommentaire('Creneau Interdit');
		  				$reservation->setIdSalle($salle);
		  				
		  				$reservation->save();
	  				}
				}
  				
  			}
  			else if ($request->getParameter('hour'))
  			{
  				if ($request->getParameter('hour'))
	  			{
					$this->errH = array();
					
	  				$params = $request->getParameter('CreneauHour');
	  			
	  				$date = date("Y-m-d",strtotime($params['date']));

					if (date("Y-m-d") > $date)
						$this->errH[] = "Impossible d'ajouter un horaire Off dans le passé";
	  			
	  				if (!isset($params['salles']))
						$this->errH[] = "Aucune salle n'a été séléctionnée";
	  			
	  				if ($params['debut']['hour'] >= $params['fin']['hour'])
	  				{
	  					if ($params['debut']['minute'] >= $params['fin']['hour'])
	  					{
	  						$this->errH[] = "Horaire de début doit précéder l'horaire de fin";
	  					}
	  				}
	  			
	  				if (count($this->errH) == 0)
	  				{
		  				foreach ($params['salles'] as $salle)
		  				{  			
		  					$reservation = new Reservation();
		  					
			  				$reservation->setIdUserReserve($this->getUser()->getGuardUser()->getId());
			  				$reservation->setIdAsso(1); // BDE
			  				$reservation->setDate($date);
			  				$reservation->setHeuredebut($params['debut']['hour'].':'.$params['debut']['minute']);
			  				$reservation->setHeurefin($params['fin']['hour'].':'.$params['fin']['minute']);
			  				$reservation->setAllday(false);
			  				$reservation->setActivite('Creneau Interdit');
			  				$reservation->setEstvalide(true);
			  				//$reservation->setCommentaire('Commentaire');
			  				$reservation->setIdSalle($salle);
			  				
			  				$reservation->save();
		  					
		  				}
		  			}
	  			}
	  		}
  		}
  		
  }
  
  /**
  *	Envoie un mail à la personne qui a reservé
  *	Si sa réservation a été modifiée par un admin
  *
  */
  private function sendMailSuppr($reservation,$commentaire)
  {
  		$mailContent = 'Bonjour,'."\n\n";
	
		$mailContent .= 'Votre demande de la salle '.$reservation->getSalle().' a été supprimée par un admin.'."\n\n";
		
		return $this->sendMail ($reservation,$commentaire,$mailContent);
  }
  
  
  /**
  *	Envoie un mail à la personne qui a reservé
  *	Si sa réservation a été modifiée par un admin
  *
  */
  private function sendMailModif($reservation,$commentaire)
  {
  		$mailContent = 'Bonjour,'."\n\n";
	
		$mailContent .= 'Votre demande de la salle '.$reservation->getSalle().' a été modifiée par un admin.'."\n\n";
		
		return $this->sendMail ($reservation,$commentaire,$mailContent);
  }
  
  /**
  *	Envoie un mail à la personne qui a reservé
  *	Si sa réservation a été validée par un admin ou non
  *
  */
  private function sendMailValid($reservation,$commentaire,$estValide)
  {
  		$mailContent = 'Bonjour,'."\n\n";
	
		$mailContent .= 'Votre demande de la salle '.$reservation->getSalle().' a été ';
	
  		if ($estValide)
			$mailContent .= 'validée.'."\n\n";
		else
			$mailContent .= 'refusée.'."\n\n";
		
		return $this->sendMail ($reservation,$commentaire,$mailContent);

  }
  
  /**
  *	FONCTION A NE PAS UTILISER !
  *	SEULEMENT POUR FAIRE D'AUTRE FONCTIONS
  *	COMME AU DESSUS
  */
  private function sendMail($reservation,$commentaire,$mailContent)
  {

  		$mailContent .= 'Rappel de la réservation : '."\n\n";
		$mailContent .= 'Date : '.$reservation->showDate()."\n";
		if (!$reservation->getAllday())
		{
			$mailContent .= 'Heure Debut : '.$reservation->getHeuredebut()."\n";
			$mailContent .= 'Heure Fin : '.$reservation->getHeurefin()."\n";
		}
		$mailContent .= 'Toute la journée : ';
		if($reservation->getAllday())
			$mailContent .= 'oui';
		else 
			$mailContent .= 'non';
			
		$mailContent .= "\n\n";

		
		if (isset($commentaire) && trim($commentaire) != "")
		{
		
			$mailContent .= 'Commentaire :'."\n";
			$mailContent .= $commentaire."\n\n";
		
		}
		
		$mailContent .= 'Ceci est un mail automatique'."\n";
		$mailContent .= 'BDE'."\n";
		
		// Envoi d'un mail de confirmation
		$message = $this->getMailer()->compose(
			array('bde@assos.utc.fr' => 'BDE - Reservation salle'),
			$reservation->getUserReserve()->getEmailAddress(),
			'Reservation d\'une salle',
			$mailContent
		);
		
		$this->getMailer()->send($message);
  	
  		return $mailContent;
  }

  public function executeStatistiques(sfWebRequest $request)
  {
  		$this->param = "statistiques";
  }

  public function executeStatSalle(sfWebRequest $request)
  {  		
  		$this->salles = SalleTable::getInstance()->getAllSalles()->execute();
		$this->statSalles = SalleTable::getInstance()->getStatSalle()->execute();
  }

  public function executeStatJour(sfWebRequest $request)
  {  		
		$this->statJours = ReservationTable::getInstance()->getStatJours();
  }

  public function executeStatMois(sfWebRequest $request)
  {  		
		$this->statMois = ReservationTable::getInstance()->getStatMois();
  }

  public function executeStatAsso(sfWebRequest $request)
  {  		
  		$this->assos = AssoTable::getInstance()->getAssosList()->execute();
		$this->statAssos = AssoTable::getInstance()->getStatAsso()->execute();
  }

  public function executeStatPole(sfWebRequest $request)
  {  		
  		$this->poles = PoleTable::getInstance()->getPolesList()->execute();	
		$this->statPoles = PoleTable::getInstance()->getStatPole()->execute();
  }  
}
