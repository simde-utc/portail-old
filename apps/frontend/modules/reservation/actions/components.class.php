<?php

class reservationComponents extends sfComponents
{

  public function executeCalendarMenu()
  {
  }
  
  public function executeListeSalles()
  {
    //$this->salles = SalleTable::getInstance()->getAllSalles()->execute();
    
    $this->salles = SalleTable::getInstance()->getSalleByPole()->execute();
   /* 
    echo $bdd;
  
    $t = array(array());
	
	 foreach ($bdd as $s)
	 {	 
	
	 	$t[$s->getPole()->getAsso()] = $s;
	 }

	 $i=0;
	 for ($i=0; $i < count($bdd); $i++)
	 {
	 	$pole = $bdd[$i]->getPole();
	 	$t[$pole][] = $bdd[$i];  
	 }
	 
	 echo $t;

    $this->salles = $t;
    */
  }
  
}

