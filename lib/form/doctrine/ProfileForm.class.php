<?php

/**
 * Profile form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfileForm extends BaseProfileForm
{

  public function configure()
  {
    unset($this['updated_at'],$this['created_at']);
  }

}
