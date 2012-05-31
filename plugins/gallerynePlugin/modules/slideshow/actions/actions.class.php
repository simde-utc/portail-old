<?php

/**
 * portfolio actions.
 *
 * @package    sfMultipleAjaxUploadGallery
 * @subpackage portfolio
 * @author     leny bernard
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class slideshowActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->galleries = Gallery::getAllGalleries();
  }

  public function executeShow(sfWebRequest $request)
  {
      $slideshowOptions["template"] = 'skitter';
      $slideshowOptions["animation"] = 'fade';
      $slideshowOptions["interval"] = 3000;
      $slideshowOptions["hasNumber"] = "true";
      $slideshowOptions["hasLabel"] = "true";
      $slideshowOptions["isNavigable"] = "true";
      $slideshowOptions["hasThumbs"] = "false";
      $slideshowOptions["hideTools"] = "true";
      $slideshowOptions["isFullscreen"] = "false";
      $this->slideshowOptions = $slideshowOptions;
    $this->gallery = $this->getRoute()->getObject();
    $this->forward404Unless($this->gallery);
  }

}
