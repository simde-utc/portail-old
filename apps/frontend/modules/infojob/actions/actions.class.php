<?php

/**
 * InfoJob actions.
 *
 * @package    simde
 * @subpackage infojob
 * @author     Soukaina B, Maureen C, Yoan T
 */
class infojobActions extends sfActions {

  public function executeIndex(sfWebRequest $request)
  {
    $query = Doctrine_Core::getTable('InfoJobOffre')
        ->createQuery('a')
        ->orderBy('a.created_at DESC');
    $this->annonces = $query->execute();
  }
  
  /**
   * 
   * 
   * @param sfRequest $request A request object
   */
  public function executeShow(sfWebRequest $request)
  {
    // TODO voir exemple dans apps/frontend/modules/assos/actions.class.php, fonction executeShow()
    $this->annonce = $this->getRoute()->getObject();
  }
}

