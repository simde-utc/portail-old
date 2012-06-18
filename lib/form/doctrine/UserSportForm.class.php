<?php

/**
 * UserSport form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserSportForm extends BaseUserSportForm
{
  public function configure()
  {
    $this->widgetSchema['id'] = new sfWidgetFormInputHidden();  
  }
}
