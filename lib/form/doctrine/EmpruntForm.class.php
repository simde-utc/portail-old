<?php

/**
 * Emprunt form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EmpruntForm extends BaseEmpruntForm
{
  public function configure()
  {
    $this->widgetSchema['materiel_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['asso_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['recu'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['rendu'] = new sfWidgetFormInputHidden();
    unset($this['created_at'],$this['updated_at']);
  }
}
