<?php
 
class eventComponents extends sfComponents
{
  public function executeCarousel()
  {
    $this->events = EventTable::getInstance()->getFutureEventsList(3)->execute();
  }
  
  public function executeLastEvents()
  {
    $this->events = EventTable::getInstance()->getLastEvents(4)->execute();
  }
}
