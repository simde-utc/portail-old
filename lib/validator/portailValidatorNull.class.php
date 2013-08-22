<?php

class portailValidatorNull extends sfValidatorBase {
  protected function configure($options = array(), $messages = array())
  {
    parent::configure($options, $messages);
    $this->addMessage('not_nullity', 'This field should be null');
  }

  protected function doClean($value)
  {
    if($value == '' or $value == NULL)
      return $value;
    else
      throw new sfValidatorError($this, 'not_nullity');
  }
}