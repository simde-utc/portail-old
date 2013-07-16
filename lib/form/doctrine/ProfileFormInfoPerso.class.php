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
      $this->useFields(array("id","mobile"));
      $this->embedRelation('HomePlace as <h3>Adresse Etu</h3>');
      $this->embedRelation('FamilyPlace as <h3>Autre Adresse</h3>');
  }

}