<?php

/**
 * Transaction form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TransactionForm extends BaseTransactionForm
{
  public function configure()
  {
      $this->widgetSchema['asso_id'] = new sfWidgetFormInputHidden();
      unset($this['created_at'], $this['updated_at'], $this['deleted_at'], $this['note_de_frais_id'], $this['budget_poste_id']);
  }
}
