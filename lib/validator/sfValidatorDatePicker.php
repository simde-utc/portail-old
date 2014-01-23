<?php

class sfValidatorDatePicker extends sfValidatorBase {
  protected function configure($options = array(), $messages = array())
  {
    parent::configure($options, $messages);
    $this->addMessage('incorrect_format', 'Le format est incorrect.');
    $this->addMessage('incorrect_year', 'L\'année est incorrecte.');
    $this->addMessage('incorrect_month', 'Le mois est incorrect.');
    $this->addMessage('incorrect_day', 'Le jour est incorrect.');
    $this->addMessage('incorrect_time_hours', 'L\'heure est incorrecte.');
    $this->addMessage('incorrect_time_minutes', 'Les minutes sont incorrectes.');
  }

  protected function doClean($value)
  {
    if(preg_match('#^\d{2}/\d{2}/\d{4} \d{2}:\d{2}$#', $value)) {
      $date = explode(' ', $value);
      $date[0] = explode('/', $date[0]);
      $date[1] = explode(':', $date[1]);
      if ($date[0][0] < 1 || $date[0][0] > 31)
        throw new sfValidatorError($this, 'incorrect_day', array('value' => $value));
      else if ($date[0][1] < 1 || $date[0][1] > 12)
        throw new sfValidatorError($this, 'incorrect_month', array('value' => $value));
      else if ($date[0][2] < 1950 || $date[0][2] > 3000)
        throw new sfValidatorError($this, 'incorrect_year', array('value' => $value));
      else if ($date[1][0] > 23)
        throw new sfValidatorError($this, 'incorrect_time_hours', array('value' => $value));
      else if ($date[1][1] > 59)
        throw new sfValidatorError($this, 'incorrect_time_minutes', array('value' => $value));
      else {
        return $date[0][2] . '-' . $date[0][1] . '-' . $date[0][0] . ' ' . implode(':', $date[1]) . ':00';
      }
    } else
      throw new sfValidatorError($this, 'incorrect_format', array('value' => $value));
  }
}