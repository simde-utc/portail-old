<?php

/**
 * Reservation form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ReservationForm extends BaseReservationForm
{

  public function configure()
  {
    //$this->useFields(array('id'));
     //unset($this['id'], $this['is_user_valid'],$this['is_user_reserve'], $this['est_valide']);
        
    
    //$this->widgetSchema['id_asso'] = new sfWidgetFormChoice(array(
    //'choices'  => Doctrine_Core::getTable('asso')->getName(),
    //'expanded' => true,
    //));
    
    //$this->widgetSchema['type'] = new sfWidgetFormChoice(array(
    //'choices'  => Doctrine_Core::getTable('Asso')->getName(),
    //'expanded' => true,
    //));
    
    //$this->widgetSchema->setLabels(array(
    //'id'    => 'ID',
    //'is_asso'      => 'Asso',
    //'id_salle'   => 'Salle',
    //));
    
    //$this->widgetSchema->setHelp('date', 'Date de debut, creneau 1, 2 ou 3h max');
  }

}
