<?php
 
class eventComponents extends sfComponents
{
  public function executeCarousel()
  {
    $this->events = EventTable::getInstance()->getFutureEventsList(20)->execute();
  }
  
  public function executeLastEvents()
  {
    $this->events = EventTable::getInstance()->getLastEvents()->execute();
  }

  public function executeLastEventsAsso()
  {
    $this->events = EventTable::getInstance()->getEventsList($asso)->execute();
  }
}
