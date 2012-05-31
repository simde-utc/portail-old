<?php

/**
 * portfolio actions.
 *
 * @package    sfMultipleAjaxUploadGallery
 * @subpackage portfolio
 * @author     leny bernard
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class portfolioActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->galleries = Gallery::getAllGalleries();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->gallery = $this->getRoute()->getObject();
    $this->forward404Unless($this->gallery);
  }

}
