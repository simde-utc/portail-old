<?php

class articleComponents extends sfComponents
{
  public function executeLastArticles()
  {
    $this->articles = ArticleTable::getInstance()->getLastArticles(5)->execute();
  }
}
