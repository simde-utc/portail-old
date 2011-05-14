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
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeList(sfWebRequest $request)
  {
  	$this->pole = null;
  	if($request->hasParameter("pole"))
  	{
  		$this->pole = PoleTable::retrieveByLogin($request->getParameter("pole"));
  		
  	}
  		
  	
    $this->assos = AssoTable::getAssosList($this->pole);
  }
}
