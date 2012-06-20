<?php

class servicesComponents extends sfComponents
{

  public function executeMyServicesFavoris()
  {
    $this->services = MembreServiceTable::getInstance()->getServicesFavoris($this->getUser()->getGuardUser()->getId())->execute();
  }


}
