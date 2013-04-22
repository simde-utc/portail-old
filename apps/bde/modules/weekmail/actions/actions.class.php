<?php

/**
 * weekmail actions.
 *
 * @package    simde
 * @subpackage weekmail
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class weekmailActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->articles = ArticleTable::getInstance()->getArticlesForWeekmail()->execute();
    $this->weekmails = WeekmailTable::getInstance()->getLast()->execute();
  }
  
  public function executeNew(sfWebRequest $request) {
      $this->form = new WeekmailForm();
  }
}
