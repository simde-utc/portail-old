<?php

class GesmailCreateForm extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'type'   => new sfWidgetFormSelect(array('choices' => array('alias' => 'Redirection', 'ml' => "Mailing-liste"))),
      'mail'    => new sfWidgetFormInput(),
    ));
  }
}