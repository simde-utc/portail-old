<?php

class CotisantsCotiserForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'login' => new sfWidgetFormInputHidden(),
    ));
  }
}