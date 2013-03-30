<?php

class cotisantsComponents extends sfComponents
{

  public function executeSearchForm()
  {
    $this->form = new CotisantsSearchForm();
  }

}
