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
  }
  
  /**
  *	Toute la gestion des salles
  **/
  
  public function executeSalles(sfWebRequest $request)
  {
  		$this->param = "salles";
  		
  		$this->setTemplate("index");
  }
  
  public function executeSalleUpdate(sfWebRequest $request)
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
  
  public function executeSalleNew(sfWebRequest $request)
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
  
  public function executeSalleDelete(sfWebRequest $request)
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
  *	Toute ma gestion des reservations
  */
  
  public function executeReservations(sfWebRequest $request)
  {
   	$this->param = "reservations";
   	
   	$this->setTemplate("index");
  }
  
  public function executereservationsValid(sfWebRequest $request)
  {
   	$this->param = "reservations";
   	
   	$this->id = $request->getParameter('id',-1);
  		
  		$this->forward404Unless(ReservationTable::getInstance()->isReservationNoValidExist($this->id));
   	
   	$this->reservation = ReservationTable::getInstance()->getReservationById()->execute();
  }
  
}
