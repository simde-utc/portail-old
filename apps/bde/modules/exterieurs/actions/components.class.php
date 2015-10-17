<?php

class exterieursComponents extends sfComponents
{
  public function executeSearchForm()
  {
    $this->form = new ExterieursSearchForm();
  }

}
