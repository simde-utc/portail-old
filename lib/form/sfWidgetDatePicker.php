<?php

class sfWidgetDatePicker extends sfWidgetFormInputText
{

  public function configure($options = array(),$attributes = array())
  {
    parent::configure($options,$attributes);
  }

  public function render($name,$value = null,$attributes = array(),$errors = array())
  {
    $this->setAttributes(array(
      'type' => 'text',
      'class' => 'datepicker'
    ));
    
    if (strtotime($value) === false) {
      $attributes['value'] = $value;
    } else {
      $attributes['value'] = date("d/m/Y H:i", strtotime($value));
    }
 
    return $this->renderContentTag(
      'input',
      "\n",
      array_merge(array('name' => $name), $attributes)
    );
  }
  
  public function getStylesheets() {
    return array(
      'jquery-ui-1.8.12.custom.css' => 'screen'
    );
  }

  public function getJavaScripts() {
    return array(
      'jquery-ui-1.8.12.custom.min.js',
      'jquery-ui-timepicker-addon.js'
    );
  }

}