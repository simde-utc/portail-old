<?php

class abonnementComponents extends sfComponents
{

  public function executeMyFlux()
  {
    $this->abonnements = ArticleTable::getInstance()->getAbonnementsFollowed($this->getUser()->getGuardUser()->getId())->execute();
  }


}
