<?php

/**
 * portailWidgetFormDate represents a date widget.
 *
 * @package    portail
 * @subpackage widget
 * @author     Florent Thévenet <florent@fthevenet.fr>
 * @version    
 */
class portailWidgetFormDate extends sfWidgetFormInput
{
  /**
   * Configures the current widget.
   *
   * Available options:
   *
   *  * format:       The date format string (%month%/%day%/%year% by default)
   *  * years:        An array of years for the year select tag (optional)
   *                  Be careful that the keys must be the years, and the values what will be displayed to the user
   *  * months:       An array of months for the month select tag (optional)
   *  * days:         An array of days for the day select tag (optional)
   *  * can_be_empty: Whether the widget accept an empty value (true by default)
   *  * empty_values: An array of values to use for the empty value (empty string for year, month, and day by default)
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    $this->addOption('format', 'yyyy-mm-dd');
  }

  public function getStylesheets()
  {
    return array('/sfFormExtraPlugin/css/datepicker.css'=>'screen');
  }

  public function getJavascripts()
  {
    return array(
      '/sfFormExtraPlugin/js/bootstrap-datepicker.js',
      '/sfFormExtraPlugin/js/bootstrap-datepicker.fr.js'
    );
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
    $input = parent::render($name, $value, array('class'=>'date'));
    $id = $this->generateId($name);
    $js = '<script type="text/javascript">
        jQuery(window).bind("load", function() {
              jQuery("#'.$id.'").datepicker({weekStart:1,
                                             language:"fr",
                                             autoclose:true,
                                             format:"'.$this->getOption('format').'"
                                            });
        })
      </script>';
    return $input . "\n" . $js;
  }
}
