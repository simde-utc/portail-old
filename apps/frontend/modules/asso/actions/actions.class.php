<?php

/**
 * asso actions.
 *
 * @package    simde
 * @subpackage asso
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class assoActions extends sfActions
{
  /**
   * Liste des associations
   * On affiche la liste de toutes les assos
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->assos = AssoTable::getInstance()->getAssosList();
    $this->setTemplate('list');
  }
  
  /**
   * Liste des associations
   * On affiche la liste des asso du pôle spécifié
   *
   * @param sfRequest $request A request object
   */
  public function executeList(sfWebRequest $request)
  {
    $this->pole = $this->getRoute()->getObject();
    $this->assos = AssoTable::getInstance()->getAssosList($this->pole->getPrimaryKey());
  }

  /**
   * 
   * 
   * @param sfRequest $request A request object
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
  }

}
