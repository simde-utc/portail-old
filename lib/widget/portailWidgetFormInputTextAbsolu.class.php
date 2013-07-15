<?php 

class portailWidgetFromInputTextAbsolu extends sfWidgetFormInputText
{
  public function render($name, $value = ' ', $attributes = array(), $errors = array())
  {
    $input = parent::render($name, abs($value), $attributes);
    return $input;
  }
}