<?php

/**
 * Document form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentForm extends BaseDocumentForm
{
  public function configure()
  {
    $this->widgetSchema['fichier'] = new sfWidgetFormInputFile(array(), array('accept'=>'application/pdf'));
    $this->validatorSchema['fichier'] = new sfValidatorPass();

    unset($this['created_at'], $this['updated_at'], $this['auteur']);

    $this->widgetSchema['asso_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['transaction_id'] = new sfWidgetFormInputHidden();
  }

  /**
   * the missing set value function to change a default after the values are bound
   * @param string $field the name of the field
   * @param mixed $value the new value
   */
  public function setValue($field, $value) {
      $this->values[$field] = $value; // set the value for this request
      $this->taintedValues[$field] = $value; // override the value entered by the user
      $this->resetFormFields(); // force a refresh on the field schema
  }
}
