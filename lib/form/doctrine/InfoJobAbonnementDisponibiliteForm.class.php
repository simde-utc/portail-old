<?php

/**
 * InfoJobAbonnementDisponibilite form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InfoJobAbonnementDisponibiliteForm extends BaseInfoJobAbonnementDisponibiliteForm
{
  public function configure()
  {
      $hidden_fields = array(
         'user_id',
        'id',
      );
      foreach($hidden_fields as $hidden_field) {
        $this->widgetSchema[$hidden_field]= new sfWidgetFormInputHidden();
  }
  }
}
