<?php

/**
 * Event
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    simde
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Event extends BaseEvent {

  public function getPole() {
    $asso = $this->getAsso();
    return ($asso->isPole()) ? $asso->getPoleInfos() : $asso->getPole();
  }

  public function getAffiche_prefixed() {
    return "/uploads/events/" . $this->getAffiche();
  }

  public function getGaleries(){
        $q = GaleriePhotoTable::getInstance()->createQuery('gal')->select('gal.*')
            ->where('gal.event_id = ?', $this->getId());
        return $q;
    }

}
