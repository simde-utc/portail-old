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

    public function getJavascripts()
    {
        return array(
                     '/sfFormExtraPlugin/js/widget-montant.js',
                     );
    }

    /**
     * @see sfWidgetForm
     */
    public function render($name, $value = 0, $attributes = array(), $errors = array())
    {
        $inp = parent::render($name.'[montant]', $value, $attributes, $errors);
        $id = $this->generateId($name);

        $state = $this->renderContentTag('input', '',
                                         array('type' => 'hidden',
                                               'name' => $name . '[state]',
                                               'id' => $id . '_hidden_state'));
        $debit = $this->renderContentTag('button', 'Débit',
                                         array('type'=>'button',
                                               'class'=>'btn',
                                               'id'=>$id.'_debit_btn'));
        $credit = $this->renderContentTag('button', 'Crédit',
                                          array('type'=>'button',
                                                'class'=>'btn',
                                                'id'=>$id.'_credit_btn'));

        $div = $this->renderContentTag('div', $inp . $debit . $credit . $state,
                                       array('class' => 'input-append',
                                             'style' => 'display: inline-block;'));

        $js = '<script type="text/javascript">
        jQuery(window).bind("load", function() {
              init_input_montant("#'.$id.'");
        })
      </script>';

        return $div . "\n" . $js;
    }
}