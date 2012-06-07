<?php

/**
 * Stock form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class StockForm extends BaseStockForm
{
  public function configure()
  {
    $this->widgetSchema['materiel_id'] = new sfWidgetFormInputHidden();
    unset($this['created_at'],$this['updated_at']);
  }
}
