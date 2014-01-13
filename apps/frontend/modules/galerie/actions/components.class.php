<?php
 
class galerieComponents extends sfComponents
{
  public function executePreview()
  {
  	if($this->sf_user->isAuthenticated()){
	    $this->photos = PhotoTable::getInstance()
	    	->getPhotosList($this->galery->getId())
	    	->limit(4)
	    	->execute();
    }else{
		$this->photos = PhotoTable::getInstance()
	    	->getPhotosPublicList($this->galery->getId())
	    	->limit(4)
	    	->execute();
	 }
    $this->photoCount = $this->photos->count();
  }
}