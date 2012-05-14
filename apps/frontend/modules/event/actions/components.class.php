<?php
 
class eventComponents extends sfComponents
{
  public function executeCarousel()
  {
    $this->events = EventTable::getInstance()->getFutureEventsList()->execute();
  }
  
  public function executeLastEvents()
  {
    $this->events = EventTable::getInstance()->getLastEvents()->limit(3)->execute();
  }
    public function executeLastEventsAsso()
  {
    $this->events = EventTable::getInstance()->getEventsList($asso)->execute();
  }
}
