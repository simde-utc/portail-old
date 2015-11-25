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
      $this->salle = SalleTable::getInstance()->getSalleById($this->idSalle)->fetchOne();
      if($this->salle)
         $PoleId= $this->salle->getIdPole();
      else
         $PoleId = NULL;

      $values = array('UserID'=> $this->UserID,'idSalle'=> $this->idSalle,'PoleId'=>$PoleId);
      
      $this->salle = SalleTable::getInstance()->getSalleById($this->idSalle)->fetchOne(); 

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
               //si c'est une asso appartenant a un pole
               if($asso->getPoleId()) 
                  $pole = PoleTable::getInstance()->getOneById($asso->getPoleId());
               //si c'est un pole
               else
                  $pole = PoleTable::getInstance()->getOneByAsso($asso);
               
               if($pole && !in_array($pole->getId(), $this->polesUser))
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
          $reservation = ReservationTable::getInstance()->getReservationById($idResa)->fetchOne();
          $this->form = new ReservationForm($reservation,$values);
        }
            
        if($request->getParameter("delete")){
           $reservation->delete();
        }                 
        else{
          $this->form->bind($request->getParameter($this->form->getName()));
             
          if ($this->form->isValid())
          { 
            $this->reservation=$this->form->save(); // Save into database 
            $this->ok=true;
            $d= new DateTime();
            $a=new DateTime($this->reservation->getDate());

            $diff = $a->diff($d);
                  
            if($diff->d<14 && $diff->y==0 && $diff->m==0 && $this->reservation->getAllday()==0){
              $this->reservation->setEstvalide(1);
              $this->reservation->save();
            }
            else{
              $this->reservation->setEstvalide(0);
              $this->reservation->save();            
            }                                    
          }
          else
            $this->afficherErreur= true;
        }
      }
    }
  }
  
  public function executeList(sfWebRequest $request)
  {
   $this->user = $this->getUser()->getGuardUser();
   
   $idSalle = $request->getUrlParameter('id',-1);
   $start = $request->getGetParameter('start', strtotime('monday this week'));
   $end = $request->getGetParameter('end', strtotime('sunday this week'));

   if($idSalle == -1)
   {

      //BDE toujours dans les poles de l'utilisateur
      $this->polesUser = array("1");

      $this->assosUser = AssoTable::getInstance()->getMyAssos($this->getUser()->getGuardUser()->getId())->execute();
      
      if($this->assosUser)
      {
         foreach($this->assosUser as $asso)
         {
            //si c'est une asso normale
            if($asso->getPoleId()) 
               $pole = PoleTable::getInstance()->getOneById($asso->getPoleId());
            //si c'est un pole
            else
               $pole = PoleTable::getInstance()->getOneByAsso($asso);
            if($pole && !in_array($pole->getId(), $this->polesUser))
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
         $resa = ReservationTable::getInstance()->getReservationsBySalleBetweenDates($salle, $start, $end)->execute();
         foreach($resa as $res)
            array_push($this->reservations, $res);
      }
   }
   else
   {
      $this->user = $this->getUser()->getGuardUser();   
      $this->reservations = ReservationTable::getInstance()->getReservationsBySalleBetweenDates($idSalle, $start, $end)->execute();
   }
  }


  public function executeShow(sfWebRequest $request)
  {
    $id = $request->getUrlParameter("id",-1);
  
    if ($id == -1)
      $this->forward404Unless(false);
  
    $this->forward404Unless(ReservationTable::getInstance()->isReservationExist($id));
  
    $this->reservation = ReservationTable::getInstance()->getReservationById($id)->fetchOne();
  }
  
  public function executeFormNew(sfWebRequest $request)
  {
   if (!$request->isXmlHttpRequest())
     $this->forward404Unless(false);
  
   $idSalle = $request->getParameter("idSalle", -1);
   $UserID = $request->getParameter("UserID", -1);
   $PoleId= SalleTable::getInstance()->getSalleById($idSalle)->fetchOne()->getIdPole();
   
   
   // création du tableau à passer au constructeur du formulaire de réservation
   $values = array('UserID'=> $UserID,'idSalle'=> $idSalle,'PoleId'=>$PoleId);
    
   $this->form = new ReservationForm(array(),$values);
   
   // valeur par défaut pour les champs cachés.
   $this->form->setDefault('id_salle', $idSalle);
   $this->form->setDefault('id_user_reserve', $UserID);
   $this->form->setDefault('estvalide', 0); 
         
   $this->ok = false;
   $this->afficherErreur= false;

   return $this->renderPartial('reservation/formNew',array('form'=>$this->form,'idSalle'=>$idSalle));
    
  }
  
  public function executeFormUpdate(sfWebRequest $request)
  {
   if (!$request->isXmlHttpRequest())
     $this->forward404Unless(false);
  
   $idSalle = $request->getParameter("idSalle", -1);
   $UserID = $request->getParameter("UserID", -1);
   $idResa = intval($request->getParameter("idResa", -1));
   
   $reservation = ReservationTable::getInstance()->getReservationById($idResa)->fetchOne();
   
   // On a pas l'id de la salle
   // Donc on va la chercher via la reservation    
   if ($idSalle == -1)
     $idSalle = $reservation->getSalle()->getId();

   $PoleId= SalleTable::getInstance()->getSalleById($idSalle)->fetchOne()->getIdPole();
   $SalleName = SalleTable::getInstance()->getSalleById($idSalle)->fetchOne()->getName();

   // création du tableau à passer au constructeur du formulaire de réservation
   $values = array('UserID'=> $UserID,'idSalle'=> $idSalle,'PoleId'=>$PoleId, 'SalleName'=>$SalleName);
    
   $this->form = new ReservationForm($reservation,$values);
   
   //$PoleId= SalleTable::getInstance()->getSalleById($idSalle)->fetchOne()->getIdPole();
   
   $this->form->setDefault('estvalide', 0);
         
   $this->ok = false;
   $this->afficherErreur= false;


   return $this->renderPartial('reservation/formUpdate',array('form'=>$this->form,'idSalle'=>$idSalle,'PoleId'=>$PoleId, 'SalleName'=>$SalleName));
    
  }

}
