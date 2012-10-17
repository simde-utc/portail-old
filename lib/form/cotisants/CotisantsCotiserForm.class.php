<?php

class CotisantsCotiserForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'login' => new sfWidgetFormInputHidden(),
      'montant' => new sfWidgetFormInputText(),
    ));
    $this->widgetSchema->setFormFormatterName('list');
  }
  
  public function hideMontant(){
    unset($this->widgetSchema["montant"]);
    unset($this->validatorSchema["montant"]);
  }
}