<?php

class portailValidatorMontant extends sfValidatorNumber{
	  /**
   * @param array $options   An array of options
   * @param array $messages  An array of error messages
   *
   * @see sfValidatorFile
   */
  protected function configure($options = array(), $messages = array())
  {
    parent::configure($options, $messages);
  }
 
  /**
   * @see sfValidatorFile
   */
  protected function doClean($value)
  {
    $clean = parent::doClean($value['montant']);

    switch($value['state']) {
    case 'debit':
        $clean = abs($clean) * -1;
        break;
    case 'credit':
        $clean = abs($clean);
        break;
    }

    return $clean;
  }
}