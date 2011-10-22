<?php
 
class assoComponents extends sfComponents
{
  public function executeArticles()
  {
    $this->articles = ArticleTable::getInstance()->getArticlesList($this->asso->getId());
  }
  
  public function executeEvents()
  {
    $this->events = EventTable::getInstance()->getEventsList($this->asso->getId());
  }
  
  public function executeBureau()
  {
    
  }
  
  public function executeTrombinoscope()
  {
    
  }
}
