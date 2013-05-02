<?php

/**
 * InfoJob actions.
 *
 * @package    simde
 * @subpackage infojob
 * @author     Soukaina B, Maureen C, Yoan T
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class infojobActions extends sfActions {

  public function executeIndex(sfWebRequest $request)
  {
    $this->filters = new AnnonceFormFilter();
    if($request->getMethod() == sfRequest::POST)
    {
      $this->filters->bind($request->getParameter($this->filters->getName()));
      if($this->filters->isValid())
      {
        $query = $this->filters->buildQuery($this->filters->getValues());
      }
    }
    else
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
  }
}

