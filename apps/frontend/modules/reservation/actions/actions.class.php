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
	$this->userIdentified = false;
	if ($this->getUser()->isAuthenticated())
	{
		$this->userIdentified= true;	      
		$this->UserID=$this->getUser()->getGuardUser()->getId();
		$this->idSalle = $request->getUrlParameter("id", -1);
		$PoleId= SalleTable::getInstance()->getSalleById($this->idSalle)->execute()[0]->getIdPole();
		$values = array('UserID'=> $this->UserID,'idSalle'=> $this->idSalle,'PoleId'=>$PoleId);
		
		$this->salle = SalleTable::getInstance()->getSalleById($this->idSalle)->execute()[0]; 

		//test si la salle appartient bien aux pole de l'utilisateur
		if($this->idSalle != -1)
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
			$this->forward404Unless(in_array($this->salle->getIdPole(), $this->polesUser));
		}	
		
		$this->ok = false;
		$this->afficherErreur= false;
		
		if ($request->isMethod('post'))
  		{
  		
		     // Récupération de l'id de la réservation actuelle ( =-1 si nouvelle réservation, =id de la réservation à modifier sinon).
		     $idResa = $request->getParameter('reservation',-1)['id'];

		     
		      if($idResa==-1){ // Cas 1: Création d'une nouvelle réservation
			  $this->form = new ReservationForm(array(),$values);
		      }
		      
		      else{ // Cas 2: Edition d'une réservation déjà existante  
			  $reservation = ReservationTable::getInstance()->getReservationById($idResa)->execute()[0];
			  $this->form = new ReservationForm($reservation,$values);
		      }
		      
		      if($PoleId==1){
			  $this->form->getWidget('id_asso')->setOption('add_empty',true);
		      }
		      
		     
		      $this->form->bind($request->getParameter($this->form->getName()));
		      if ($this->form->isValid())
		      {

			
				$this->reservation=$this->form->save(); // Save into database 
				//$idResa=$this->reservation->getId();
				$this->ok=true;

								
				$d= new DateTime();
				$a=new DateTime($this->reservation->getDate());
				var_dump($this->reservation->getDate());
				$diff = $a->diff($d);
				
				
				if($diff->d<14 && $diff->y==0 && $diff->m==0 && $this->reservation->getAllday()==0){
				      $this->reservation->setEstvalide(1);
				      $this->reservation->save();
				}
				else{
				      $this->reservation->setEstvalide(0);
				      $this->reservation->save();				
				}
				
				/*if($this->reservation->getAllday()){
				      $this->reservation->setHeuredebut('08:00:00');
				      $this->reservation->setHeurefin('23:59:00');
				      $this->reservation->save();
				}*/
				
			}
			else
			{
			      $this->afficherErreur= true;
			}
		      
		      
		      
  		}



		

		/*if($request->isMethod(sfRequest::PUT)){
		
			$form_param = $request->getParameter($this->form->getName());
			var_dump("gros saac");
			var_dump($form_param['id']);
			$this->form->bind($request->getParameter($this->form->getName()));
			if ($this->form->isValid())
			{
			var_dump("coucou");
			$a=$request->getParameter($this->form->getName());
			var_dump($a);
			
			}*/
			
				
				/*$a=$request->getParameter($this->form->getName());
		    $this->form->bind($request->getParameter($this->form->getName()));
		    var_dump("lalalal");
		    $a=$request->getParameter($this->form->getName());
		    var_dump($a);
		    var_dump($a['id']);*/
		    
		/*}*/
		/*var_dump($request->isMethod('post'));
		
		

			      $a=$request->getParameter($this->form->getName());
			      var_dump($a);
			      var_dump($a['id']);*/

 
		
  		/*if ($request->isMethod('put'))
  		{
  						var_dump("COUCOUUUUUUUUUUUUU");
				//var_dump($res);
  			$this->form->bind($request->getParameter($this->form->getName()));
			if ($this->form->isValid())
			{	
			
				
				$a=$request->getParameter($this->form->getName());
				$date= $a['date']['year'];
				$date.="-";
				$date.=(strlen($a['date']['month'])<2)?"0".$a['date']['month']:$a['date']['month'];
				$date.="-";
				$date.=(strlen($a['date']['day'])<2)?"0".$a['date']['day']:$a['date']['day'];
				
				$heureD=(strlen($a['heuredebut']['hour'])<2)?"0".$a['heuredebut']['hour']:$a['heuredebut']['hour'];
				$heureD.=":";
				$heureD.=$a['heuredebut']['minute'];
				$heureD.=":00";
				
				$heureF=(strlen($a['heurefin']['hour'])<2)?"0".$a['date']['hour']:$a['date']['hour'];
				$heureF.=":";
				$heureF.=$a['heurefin']['minute'];
				$heureF.=":00";
				
				$res = new Reservation();
				
				$res->setId($a['id']);
				$res->setIdUserValid($a['id_user_valid']);
				$res->setIdUserReserve($a['id_user_reserve']);
				$res->setIdAsso($a['id_asso']);
				$res->setIdSalle($a['id_salle']);
				$res->setDate($date);
				$res->setHeuredebut($heureD);
				$res->setHeurefin($heureF);
				$res->setAllday($a['allday']);
				/*if($a['allday'])
				  $res->setEstvalide(0);*/
				/*$res->setActivite($a['activite']);
				$res->setCommentaire($a['commentaire']);
				

				
				// permet de mettre à jour si le réservation est valide ou non ( deux semaines avant ou pas).
				
				$d=new DateTime();
				$a=new DateTime($res->getDate());
				$diff = $a->diff($d);
				if($diff->d<14 && $res->getAllday()==0){
				    $q = Doctrine_Query::create()
				    ->update('Reservation')
				    ->set('estvalide', '?', 1)
				    ->where('id = ?', $idResa)
				    ->execute();
				}

			}
			else
			{
			      var_dump("NOvalide");
			      $this->afficherErreur= true;
			}
		}*/
  	      
	}
	 
  }
  
  public function executeList(sfWebRequest $request)
  {
	$this->user = $this->getUser()->getGuardUser();
	
	$idSalle = $request->getUrlParameter('id',-1);
	
	if($idSalle == -1)
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
	else
	{
		$this->user = $this->getUser()->getGuardUser();	
  		$this->reservations = ReservationTable::getInstance()->getReservationBySalle($idSalle)->execute();
	}
  }


  public function executeShow(sfWebRequest $request)
  {
  		$id = $request->getUrlParameter("id",-1);
  
  		if ($id == -1)
  			$this->forward404Unless(false);
  
  		$this->forward404Unless(ReservationTable::getInstance()->isReservationExist($id));
  
		$this->reservation = ReservationTable::getInstance()->getReservationById($id)->execute()[0];
  }
  
  public function executeFormNew(sfWebRequest $request)
  {
	if (!$request->isXmlHttpRequest())
	{
	  $this->forward404Unless(false);
	}
  
	$idSalle = $request->getParameter("idSalle", -1);
	$UserID = $request->getParameter("UserID", -1);
	$PoleId= SalleTable::getInstance()->getSalleById($idSalle)->execute()[0]->getIdPole();
	
	
	// création du tableua à passer au constructeur du formulaire de réservation
	$values = array('UserID'=> $UserID,'idSalle'=> $idSalle,'PoleId'=>$PoleId);
    
	$this->form = new ReservationForm(array(),$values);
	
	// TO DO : Voir si la salle appartient au BDE ou non et en fonction donner possiblité de rentrer une asso ou non.

	
	if($PoleId==1){
	    $this->form->getWidget('id_asso')->setOption('add_empty',true);
	}
	

	
	// valeur par défaut pour les champs cachés.
	$this->form->setDefault('id_salle', $idSalle);
	$this->form->setDefault('id_user_reserve', $UserID);
	$this->form->setDefault('estvalide', 0); 
			
	$this->ok = false;
	$this->afficherErreur= false;


	return $this->renderPartial('reservation/form',array('form'=>$this->form,'idSalle'=>$idSalle));
	 
  }
  
  public function executeFormUpdate(sfWebRequest $request)
  {
	if (!$request->isXmlHttpRequest())
	{
	  $this->forward404Unless(false);
	}
  
	$idSalle = $request->getParameter("idSalle", -1);
	$UserID = $request->getParameter("UserID", -1);
	$idResa = intval($request->getParameter("idResa", -1));
	$PoleId= SalleTable::getInstance()->getSalleById($idSalle)->execute()[0]->getIdPole();
	
	$reservation = ReservationTable::getInstance()->getReservationById($idResa)->execute()[0];
	
	// On a pas l'id de la salle
	// Donc on va la chercher via la reservation 	
	if ($idSalle == -1)
	{
	  $idSalle = $reservation->getSalle()->getId();
	}
	
	
	// création du tableua à passer au constructeur du formulaire de réservation
	$values = array('UserID'=> $UserID,'idSalle'=> $idSalle,'PoleId'=>$PoleId);
    
	$this->form = new ReservationForm($reservation,$values);
	
	// TODO : Voir si la salle appartient au BDE ou non et en fonction donner possiblité de rentrer une asso ou non.
	$PoleId= SalleTable::getInstance()->getSalleById($idSalle)->execute()[0]->getIdPole();
	
	if($PoleId==1){
	    $this->form->getWidget('id_asso')->setOption('add_empty',true);
	}
	
	$this->form->setDefault('estvalide', 0);
			
	$this->ok = false;
	$this->afficherErreur= false;


	return $this->renderPartial('reservation/form',array('form'=>$this->form,'idSalle'=>$idSalle,'PoleId'=>$PoleId));
	 
  }

}
