<?php

class CotisantsSearchForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
      //'nom'    => new sfWidgetFormInputText(),
      'login' => new sfWidgetFormInputText(),
    ));
  }
}