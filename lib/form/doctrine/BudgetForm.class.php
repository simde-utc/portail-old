<?php

/**
 * Budget form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BudgetForm extends BaseBudgetForm
{
  public function configure() {
    $this->widgetSchema['asso_id'] = new sfWidgetFormInputHidden();
    $this->setDefault('semestre_id', sfConfig::get('app_portail_current_semestre'));
    unset($this['created_at'], $this['updated_at']);
  }
}
