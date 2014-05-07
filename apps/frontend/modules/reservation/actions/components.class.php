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
		$this->assosUser = AssoTable::getInstance()->getMyAssos($this->getUser()->getGuardUser()->getId())->execute();
		if($this->assosUser)
		{
			$this->polesUser = array();
			foreach($this->assosUser as $asso)
			{
				$pole = PoleTable::getInstance()->getOneById($asso->getPoleId());
				if(!in_array($pole->getId(), $this->polesUser))
					array_push($this->polesUser, $pole->getId());
			}
		}
	}
    $this->salles = SalleTable::getInstance()->getSalleByPole()->execute();
  }

}

