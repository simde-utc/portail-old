<?php

class voteActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->listes = VoteListeTable::getInstance()->getCurrentLists()->execute();
    $this->is_cotisant = $this->isCotisant();
    $this->has_voted = VoteTable::getInstance()->getVoteForUserAndSemestre($this->getUser()->getGuardUser()->getPrimaryKey(),sfConfig::get('app_portail_current_semestre'))->fetchOne();
  }

  public function executeVote(sfWebRequest $request) {
    $liste_id = $request->getParameter('id');
    if($liste_id != 0)
      $liste = $this->getRoute()->getObject();
    else
      $liste = 0;
    if($liste_id != 0 && !$liste) {
      $this->getUser()->setFlash('error','Cette liste n\'existe pas.');
    } else
    if($liste_id != 0 && $liste->getSemestreId() != sfConfig::get('app_portail_current_semestre')) {
      $this->getUser()->setFlash('error','Vous ne pouvez pas voter pour cette liste.');
    } else
    if(!$this->isCotisant()) {
      $this->getUser()->setFlash('error','Vous n\'êtes pas cotisant. Vous ne pouvez pas participer aux élections du BDE.');
    } else {
      if(VoteTable::getInstance()->getVoteForUserAndSemestre($this->getUser()->getGuardUser()->getPrimaryKey(),sfConfig::get('app_portail_current_semestre'))->fetchOne()) {
        $this->getUser()->setFlash('error','Vous avez déjà voté.');
      } else {
        $vote = new Vote();
        $vote->setIp($_SERVER['REMOTE_ADDR']);
        $vote->setSemestreId(sfConfig::get('app_portail_current_semestre'));
        $vote->setUserId($this->getUser()->getGuardUser()->getId());
        $vote->setLogin($this->getUser()->getGuardUser()->getUsername());
        $vote->save();

        if($liste_id != 0) {
          $pdo = Doctrine_Manager::getInstance()->getCurrentConnection()->getDbh();
          $stmt = $pdo->prepare('UPDATE `vote_liste` SET `count`=(`count`+1) WHERE `id` = :id');
          $stmt->bindParam(':id', $liste->getPrimaryKey(), PDO::PARAM_INT);
          $stmt->execute();
        }

        $this->getUser()->setFlash('success','Votre vote a été pris en compte.');
      }
    }
    $this->redirect('homepage');
  }

  private function isCotisant() {
    try {
      $ginger = new \Ginger\Client\GingerClient(sfConfig::get('app_portail_ginger_key'));
      $cotisant = $ginger->getUser($this->getUser()->getUsername());
      return $cotisant->is_cotisant;
    }
    catch (\Ginger\Client\ApiException $ex){
      if($ex->getCode() == 404){
        $error = "Utilisateur non trouvé";
      }
      else {
        $error = $ex->getCode()." - ".$ex->getMessage();
      }
      return false;
    }
  }
}
