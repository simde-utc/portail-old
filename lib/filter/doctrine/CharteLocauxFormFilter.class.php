<?php

/**
 * CharteLocaux filter form.
 *
 * @package    simde
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CharteLocauxFormFilter extends BaseCharteLocauxFormFilter
{
  public function configure()
  {
  //ne marche pas pourqoi????  
  //$this->widgetSchema['statut'] = new sfWidgetFormChoice(array('choices' => array('' => 'Tous les statuts', 1 => 'Charte acceptée par l\'étudiant', 2 => 'Charte validée par le président', 3 => 'Charte validée par le BDE')));
  //$this->validatorSchema['statut']= new sfValidatorChoice(array('required' => false, 'choices' => array('', '1', '0', '2', '3')));

   unset( $this['created_at'], $this['updated_at'], $this['ip'], $this['date'], $this['user_id'], $this['motif']);
  }
}
