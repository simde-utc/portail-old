<?php

/**
 * Profile form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfileFormInfoPerso extends BaseProfileForm
{
  public function configure()
  {
      $this->widgetSchema->setLabel('mobile', '<b>Portable</b>');
      $this->widgetSchema->setLabel('home_place', '<b>Adresse Etu</b>');
      $this->widgetSchema->setLabel('family_place', '<b>Autre Adresse</b>');
      $this->useFields(array("id","mobile"));
      $this->embedRelation('HomePlace');
      $this->embedRelation('FamilyPlace');
  }

}