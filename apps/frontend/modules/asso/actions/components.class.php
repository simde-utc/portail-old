<?php

class assoComponents extends sfComponents
{

  public function executeArticles()
  {
    $this->articles = ArticleTable::getInstance()->getArticlesList($this->asso);
  }

  public function executeEvents()
  {
    $this->events = EventTable::getInstance()->getEventsList($this->asso);
  }

  public function executeBureau()
  {
    
  }

  public function executeTrombinoscope()
  {
    
  }

  /**
   * @todo: n'afficher que les assos auxquelles on participe actuellement
   */
  public function executeMyAssos()
  {
    $this->assos = AssoTable::getInstance()->getMyAssos($this->getUser()->getGuardUser()->getId());
  }

}
