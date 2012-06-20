<?php

/**
 * Profile form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfileFormInfoSupp extends BaseProfileForm
{

  public function configure()
  {
      $this->widgetSchema->setLabel('devise', '<b>Devise</b>');
      $this->widgetSchema->setLabel('nickname', '<b>Surnom</b>');
      $this->useFields(array("id","devise","nickname"));
  }

}