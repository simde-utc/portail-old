<?php

class ValidatorNumberNotNull extends sfValidatorNumber{
	  /**
   * @param array $options   An array of options
   * @param array $messages  An array of error messages
   *
   * @see sfValidatorFile
   */
  protected function configure($options = array(), $messages = array())
  {
    parent::configure($options, $messages);
 
    $this->addMessage('not_nullity', 'This field should not be 0');
 
    $this->addOption('not_null');
  }
 
  /**
   * @see sfValidatorFile
   */
  protected function doClean($value)
  {
    $clean = parent::doClean($value);
 
    if($clean == 0){
        throw new sfValidatorError($this, 'not_nullity');
    }
 
    return $clean;
  }
}