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

    $this->totalVisible= $this->galery->countPhotosVisible($this->isStudent);
    $this->totalPrivate= $this->galery->countPhotosVisible(True);
    $this->showMoreButton=($this->totalPrivate>count($this->photos));
    if($this->showMoreButton)
      $this->thumbsToDisplay=min(count($this->photos),3);
    else
      $this->thumbsToDisplay=count($this->photos);
    }
}