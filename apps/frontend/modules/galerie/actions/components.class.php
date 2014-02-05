<?php

class galerieComponents extends sfComponents
{
  public function executePreview()
  {
    $this->isStudent=$this->getUser()->isAuthenticated();
  	$this->photos = PhotoTable::getInstance()
      ->getPhotos(
        	$this->galery->getId(),
        	$this->isStudent
        	)
		  ->limit(4)
    	->execute();
  }
}