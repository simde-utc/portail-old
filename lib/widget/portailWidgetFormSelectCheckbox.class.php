<?php

class portailWidgetFormSelectCheckbox extends sfWidgetFormSelectCheckbox
{
    /**
     * Constructor.
     *
     * Available options:
     *
     *  * dynamic_attributes:        Attributs HTML à rajouter à partir du modèle. C'est un array(attribute_name => method)
     *
     * @see sfWidgetFormSelectCheckbox
     */
    protected function configure($options = array(), $attributes = array())
    {
        $this->addOption('dynamic_attributes', array());

        parent::configure($options, $attributes);
    }

  /*
   * On est obligé de surcharger render sinon sfWidgetFormSelectCheckbox
   * croit qu'on fait des groupes et casse l'organisation faite dans portailWidgetDoctrineChoice
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    if ('[]' != substr($name, -2))
    {
      $name .= '[]';
    }

    if (null === $value)
    {
      $value = array();
    }

    $choices = $this->getChoices();

    return $this->formatChoices($name, $value, $choices, $attributes);
  }

  /* On va juste ajouter les attributs qui nous intéressent */
  protected function formatChoices($name, $value, $choices, $attributes)
  {
    $inputs = array();
    foreach ($choices as $key => $option)
    {
      $baseAttributes = array(
        'name'  => $name,
        'type'  => 'checkbox',
        'value' => self::escapeOnce($key),
        'id'    => $id = $this->generateId($name, self::escapeOnce($key))
      );

      foreach ($this->getOption('dynamic_attributes') as $attr => $method) {
          $baseAttributes[$attr] = $option[1]->$method();
      }

      if ((is_array($value) && in_array(strval($key), $value)) || (is_string($value) && strval($key) == strval($value)))
      {
        $baseAttributes['checked'] = 'checked';
      }

      $inputs[$id] = array(
        'input' => $this->renderTag('input', array_merge($baseAttributes, $attributes)),
        'label' => $this->renderContentTag('label', self::escapeOnce($option[0]), array('for' => $id)),
      );
    }

    return call_user_func($this->getOption('formatter'), $this, $inputs);
  }
}
