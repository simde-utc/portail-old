<?php

class galerieComponents extends sfComponents
{
  public function executePreview()
  {
  	$this->photos = PhotoTable::getInstance()
        ->getPhotos(
        	$this->galery->getId(),
        	$this->sf_user->isAuthenticated()
        	)
		->limit(4)
    	->execute();
    
  }
}