<?php

class assoComponents extends sfComponents
{

  public function executeArticles()
  {
    $this->articles = ArticleTable::getInstance()->getArticlesList($this->asso)->execute();
  }

  public function executeEvents()
  {
    $this->events = EventTable::getInstance()->getEventsList($this->asso);
  }

  public function executeBureau()
  {
    $this->bureau = AssoMemberTable::getInstance()->getBureau($this->asso);
  }

  public function executeTrombinoscope()
  {
    $this->membres = AssoMemberTable::getInstance()->getMembres($this->asso);
  }

  /**
   * @todo: n'afficher que les assos auxquelles on participe actuellement
   */
  public function executeMyAssos()
  {
    $this->assos = AssoTable::getInstance()->getMyAssos($this->getUser()->getGuardUser()->getId());
  }
  
  public function executeRandomAsso()
  {
    $this->asso = AssoTable::getInstance()->getRandom();
  }

}
