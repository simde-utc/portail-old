<?php

class Doctrine_Template_Listener_Gallerify extends Doctrine_Record_Listener
{

  public function __construct($options = array())
  {
    $this->_options = $options;
  }
    
    public function preInsert(Doctrine_Event $event) {
        $invoker = $event->getInvoker();
        $className = get_class($event->getInvoker());
        $gallery = new Gallery();
        $gallery->setTitle(time().$className."-gallery");
        $gallery->setPrivate(true);
        $gallery->setDescription("---");
        $gallery->save();
        $invoker->setGallery($gallery);
        parent::preInsert($event);
    }
    public function postSave(Doctrine_Event $event) {
        $invoker = $event->getInvoker();
        $gallery = $invoker->getGallery();
        $gallery->setTitle(get_class($invoker)."-gallery".$invoker->__toString());
        $gallery->save();
        parent::postSave($event);
    }
}