<?php

class ExterieursSearchForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
      //'nom'    => new sfWidgetFormInputText(),
      'tag' => new sfWidgetFormInputText(),
    ));
  }
}