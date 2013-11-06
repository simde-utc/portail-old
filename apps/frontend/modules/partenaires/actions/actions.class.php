<?php

/**
 * partenaires actions.
 *
 * @package    simde
 * @subpackage partenaires
 * @author     Barthelemy Arribe
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class partenairesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->partenaires = PartenaireTable::getInstance()->getPartenairesList()->execute();
    $this->carnetAvantages = CarnetAvantagesTable::getInstance()->getCarnetAvantagesList()->execute();
  }
}
