<?php

/**
 * infojob actions.
 *
 * @package    bde
 * @subpackage infojob
 * @author     Soukaina Bouaziz, Maureen Corvo, Yoan Tournade
 */
class infojobActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    
  }
  
  public function executeSignalement(sfWebRequest $request) {
    // TODO Récupérer les signalements.
    // TODO En POST, permettre de les valider (engendre l'archivage de l'offre et du signalement) ou de les décliner (archive le signalement).
  }
}
