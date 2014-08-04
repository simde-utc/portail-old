<?php

/**
 * Salle form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SalleForm extends BaseSalleForm
{
  public function configure()
  {
    $this->widgetSchema->setLabels(array(
      'name'    => 'Nom',
      'id_pole' => 'Pole',
    ));
     
     $this->validatorSchema['couleur']->setOption('min_length', 6);

     $this->widgetSchema['couleur']->setAttribute('class','color');
  }
}
