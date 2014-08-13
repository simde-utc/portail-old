<?php
/**
* sfWidgetFormDoctrineChoiceWithParams represents a sfWidgetFormDoctrineChoice with parameter capability on table_method.
*/
class sfWidgetFormDoctrineChoiceWithParams extends sfWidgetFormDoctrineChoice {
  /**
  * @see sfWidget
  */
  public function __construct($options = array(), $attributes = array()) {
    $options['choices'] = array();
    parent::__construct($options, $attributes);
  }
  /**
  * Constructor.
  *
  * Available options:
  *
  *  * model:        The model class (required)
  *  * add_empty:    Whether to add a first empty value or not (false by default)
  *                  If the option is not a Boolean, the value will be used as the text value
  *  * method:       The method to use to display object values (__toString by default)
  *  * key_method:   The method to use to display the object keys (getPrimaryKey by default)
  *  * order_by:     An array composed of two fields:
  *                    * The column to order by the results (must be in the PhpName format)
  *                    * asc or desc
  *  * query:        A query to use when retrieving objects
  *  * multiple:     true if the select tag must allow multiple selections
  *  * table_method: A method to return either a query, collection or single object
  *
  * @see sfWidgetFormSelect
  */
  protected function configure($options = array(), $attributes = array()) {
    $this->addRequiredOption('model');
    $this->addOption('add_empty', false);
    $this->addOption('method', '__toString');
    $this->addOption('key_method', 'getPrimaryKey');
    $this->addOption('order_by', null);
    $this->addOption('query', null);
    $this->addOption('multiple', false);
    $this->addOption('table_method', null);
    parent::configure($options, $attributes);
  }
  /**
  * Returns the choices associated to the model.
  *
  * @return array An array of choices
  */
  public function getChoices() {
    $choices = array();
    if (false !== $this->getOption('add_empty')) {
      $choices[''] = true === $this->getOption('add_empty') ? '' : $this->translate($this->getOption('add_empty'));
    }
    if (null === $this->getOption('table_method')) {
      $query = null === $this->getOption('query') ? Doctrine_Core::getTable($this->getOption('model'))->createQuery() : $this->getOption('query');
      if ($order = $this->getOption('order_by')) {
        $query->addOrderBy($order[0] . ' ' . $order[1]);
      }
      $objects = $query->execute();
    } else {
      $results = $this->callTableMethod();
      if ($results instanceof Doctrine_Query) {
        $objects = $results->execute();
      } else if ($results instanceof Doctrine_Collection) {
        $objects = $results;
      } else if ($results instanceof Doctrine_Record) {
        $objects = new Doctrine_Collection($this->getOption('model'));
        $objects[] = $results;
      } else {
        $objects = array();
      }
    }
    $method = $this->getOption('method');
    $keyMethod = $this->getOption('key_method');
    foreach ($objects as $object) {
      $choices[$object->$keyMethod()] = $object->$method();
    }
    return $choices;
  }
  /**
  * Gets result for 'choices' from the Table class of model
  *
  * @return mixed Result of table method [Doctrine_Query, Doctrine_Collection, Doctrine_Record]
  */
  private function callTableMethod() {
    $tableMethod = $this->getOption('table_method');
    if (is_array($tableMethod)) {
      $results = call_user_func_array(array(Doctrine::getTable($this->getOption('model')),
        $tableMethod['method']), $tableMethod['parameters']);
    } else {
      $results = Doctrine::getTable($this->getOption('model'))->$tableMethod();
    }
    return $results;
  }
}
?>
