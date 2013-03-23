<?php

class assoComponents extends sfComponents
{
  public function executeMyAssos()
  {
    $this->assos = AssoTable::getInstance()->getMyAssos($this->getUser()->getGuardUser()->getId())->execute();
  }
  
  public function executeMenu() {
     $this->assos = AssoTable::getInstance()->getMyAssos($this->getUser()->getGuardUser()->getId())->execute();
  }
}
