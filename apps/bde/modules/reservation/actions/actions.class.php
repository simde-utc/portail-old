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
  
  public function executeSalles(sfWebRequest $request)
  {
  		$this->param = "salles";

   	$this->salles = SalleTable::getInstance()->getAllSalles()->execute();
  		
  		$this->setTemplate("index");
  }
  
  public function executeSalleUpdate(sfWebRequest $request)
  {
  
  		$this->param = "salles";
  		
  		$this->id = $request->getParameter('id',-1);
  		
  		$this->forward404Unless(SalleTable::getInstance()->isSalleExist($this->id));
  
  		$this->salle_modif = SalleTable::getInstance()->getSalleById($this->id)->execute();
		
		$this->form = new SalleForm($this->salle_modif[0]);
  		
  		// Si le formulaire a été envoyé
  		if ($request->isMethod('post'))
  		{
  			$this->form->bind($request->getParameter('salle'));
  			
  			// Le formulaire est valide
  			if ($this->form->isValid())
  			{
  				$this->salle_new = $request->getPostParameter('salle');
  				
  				$new = $this->form->save();
  			}  			
  		
  		}
  		else
  		{
  			
  		}
  		

  }
  
  public function executeSalleNew(sfWebRequest $request)
  {
  		$this->param = "salles";
  		
  		$this->form = new SalleForm();
  
  }
  
  public function executeSalleDelete(sfWebRequest $request)
  {
  		$this->param = "salles";
  		
  		$this->id = $request->getParameter('id',-1);
  		
  		$this->forward404Unless(SalleTable::getInstance()->isSalleExist($this->id));
  		
  		$this->salle = SalleTable::getInstance()->getSalleById($this->id)->execute()[0];
  }
  
  public function executeReservations(sfWebRequest $request)
  {
   	$this->param = "reservations";
   	
   	$this->setTemplate("index");
  }
}
