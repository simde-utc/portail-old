<?php

require_once dirname(__FILE__).'/../lib/charte_infoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/charte_infoGeneratorHelper.class.php';

/**
 * charte_info actions.
 *
 * @package    simde
 * @subpackage charte_info
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class charte_infoActions extends autoCharte_infoActions
{
  public function executeIndex(sfWebRequest $request) {
    // sorting
    if (!$request->getParameter('sort') && !$this->isValidSortColumn($request->getParameter('sort'))) {
      $request->setParameter('sort', 'date');
      $request->setParameter('sort_type', 'desc');
    }

    parent::executeIndex($request);
  }
}
