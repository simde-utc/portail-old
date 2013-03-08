<?php

class assoComponents extends sfComponents
{

  public function executeArticles()
  {
    $this->articles = ArticleTable::getInstance()->getArticlesList($this->asso)->execute();
  }

  public function executeEvents()
  {
    $this->events = EventTable::getInstance()->getFutureEventsList(4, $this->asso)->execute();
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
    $this->prev_assos = AssoTable::getInstance()->getMyPrevAssos($this->getUser()->getGuardUser()->getId())->execute();
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
    if($login = $request->getParameter('login', null))
      $this->asso = AssoTable::getInstance()->getOneByLogin($login)->select('q.id, q.login')->fetchOne();
    else if($login = $request->getParameter('asso', null))
      $this->asso = AssoTable::getInstance()->getOneByLogin($login)->select('q.id, q.login')->fetchOne();
    else
      $this->asso = AssoTable::getInstance()->getOneById(1)->select('q.id, q.login')->fetchOne(); // BDE
    if($this->asso) {
      if($this->asso->isPole())
        $this->couleur = PoleTable::getInstance()->findOneBy('asso_id', $this->asso->getId())->getCouleur();
      else
        $this->couleur = $this->asso->getPole()->getCouleur();
    }

    /*
     * Si l'utilisateur est membre
     * et que l'association n'a pas de président,
     * on lui propose de suivre la procédure de signature de charte.
     */
    if($this->getUser()->isAuthenticated()
      && $this->asso
      && $this->getUser()->getGuardUser()->isMember($this->asso->getLogin()))
    {
      $pres = AssoMemberTable::getInstance()->getPresident($this->asso)->fetchOne();
      $this->charte = (!$pres)?true:false;
    }
    else
      $this->charte = false;
  }
}
