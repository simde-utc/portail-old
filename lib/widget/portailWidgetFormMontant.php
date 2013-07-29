<?php

/**
 * portailWidgetFormDate represents a date widget.
 *
 * @package    portail
 * @subpackage widget
 * @author     Florent Thévenet <florent@fthevenet.fr>
 * @version    
 */
class portailWidgetFormMontant extends sfWidgetFormInput
{
  protected function configure($options = array(), $attributes = array())
  {
    
  }

  /**
   * Renders the widget.
   *
   * @param  string $name        The element name
   * @param  string $value       The date displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = ' ', $attributes = array(), $errors = array())
  {
    
    if ($value > 0) {
      $debit_class = 'btn';
      $credit_class = 'btn active';
    } else {
      $debit_class = 'btn active';
      $credit_class = 'btn';
    }
    $inp = $this->renderTag('input', array('type' => 'hidden', 'name' => $name));
    $debit = $this->renderContentTag('button', 'Débit', array('type'=>'button', 'class'=>$debit_class));
    $credit = $this->renderContentTag('button', 'Crédit', array('type'=>'button', 'class'=>$credit_class));
    $buttons = $this->renderContentTag('div', $debit.$credit, array('class'=>'btn-group',
                                                                    'data-toggle'=>'buttons-radio',
                                                                     'style' => 'display: inline-block;'));
    return $inp.$buttons;
  }
}