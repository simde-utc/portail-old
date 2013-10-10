<?php

/**
 * Place form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PlaceForm extends BasePlaceForm
{
  public function configure()
  {
      $this->widgetSchema->setLabel('street', '<b>N° et Rue</b>');
      $this->widgetSchema->setLabel('zipcode', '<b>Code Postal</b>');
      $this->widgetSchema->setLabel('city', '<b>Ville</b>');
      $this->widgetSchema->setLabel('country', '<b>Pays</b>');

      unset($this['updated_at'],$this['created_at'], $this['phone']);
  }
}
