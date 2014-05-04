<?php

class reservationComponents extends sfComponents
{

  public function executeInsideMenu()
  {
  }
  
  public function executeSalle()
  {
  		$this->salles = SalleTable::getInstance()->getAllSalles()->execute();
  }
  
  public function executeReservation()
  {
  		$this->reservations = ReservationTable::getInstance()->getReservationNoValide()->execute();
  }
  
}

