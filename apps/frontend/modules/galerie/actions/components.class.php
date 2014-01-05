<?php
 
class galerieComponents extends sfComponents
{
  public function executePreview()
  {
  	if($this->sf_user->isAuthenticated()){
	    $this->photos = PhotoTable::getInstance()
	    	->getPhotosList($this->galery->getId())
	    	->limit(3)
	    	->execute();
    }else{
		$this->photos = PhotoTable::getInstance()
	    	->getPhotosPublicList($this->galery->getId())
	    	->limit(3)
	    	->execute();
	 }
    $this->photoCount=PhotoTable::getInstance()
    	->getPhotosList($this->galery->getId())
    	->execute()->count();
  }
}