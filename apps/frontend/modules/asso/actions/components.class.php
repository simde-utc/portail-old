<?php

class assoComponents extends sfComponents
{

  public function executeArticles()
  {
    $this->articles = ArticleTable::getInstance()->getArticlesList($this->asso)->execute();
  }

  public function executeEvents()
  {
    $this->events = EventTable::getInstance()->getEventsList($this->asso)->execute();
  }

  public function executeBureau()
  {
    $this->bureau = AssoMemberTable::getInstance()->getBureau($this->asso)->execute();
  }

  public function executeTrombinoscope()
  {
    $this->membres = AssoMemberTable::getInstance()->getMembres($this->asso)->execute();
  }

  /**
   * @todo: n'afficher que les assos auxquelles on participe actuellement
   */
  public function executeMyAssos()
  {
    $this->assos = AssoTable::getInstance()->getMyAssos($this->getUser()->getGuardUser()->getId())->execute();
  }

  public function executeRandomAsso()
  {
    $this->asso = AssoTable::getInstance()->getRandom();
  }

  public function executeBigMenu()
  {
    $assos = AssoTable::getInstance()->getAssosAndNotPolesList();

    foreach($assos as $asso)
    {
      $poles[$asso->getPoleId()][] = $asso;
    }
    $this->poles = $poles;
  }
  
  public function executeMenu(sfWebRequest $request)
  {
    if($login = $request->getParameter('login',null))
      $this->asso = AssoTable::getInstance()->getOneByLogin($login)->select('q.id, q.login')->fetchOne();
    else
      $this->asso = AssoTable::getInstance ()->getOneById(1)->select('q.id, q.login')->fetchOne(); // BDE
    
    if($this->asso->isPole())
      $this->couleur = PoleTable::getInstance()->findOneBy('asso_id', $this->asso->getId())->getCouleur();
    else
      $this->couleur = $this->asso->getPole()->getCouleur();
  }

  public function executeContact(sfWebRequest $request)
  {
    if($login = $request->getParameter('login',null))
      $this->asso = AssoTable::getInstance()->getOneByLogin($login)->select('q.id, q.login, q.name, q.phone, q.salle, q.url_site, q.facebook')->fetchOne();
    else
      $this->asso = AssoTable::getInstance ()->getOneById(1)->select('q.id, q.login, q.name, q.phone, q.salle, q.url_site, q.facebook')->fetchOne(); // BDE
  }

}
