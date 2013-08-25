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
    $this->widgetSchema['statut'] = new sfWidgetFormChoice(array('choices' => array( 0 => 'Tous les statuts', 1 => 'Charte acceptée par l\'étudiant', 2 => 'Charte validée par le président', 3 => 'Charte validée par le BDE')));
    $this->validatorSchema['statut'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 0, 1, 2, 3)));
  }

    public function getFields()
  {
    $fields = parent::getFields();
    $fields['statut'] = 'Number';
    return $fields;
  }

  protected function addStatutColumnQuery(Doctrine_Query $query, $field, $value)
  {
    if($value == 0) $query->andWhere( $query->getRootAlias().'.statut <> ?', $value);
    if($value != 0) $query->andWhere( $query->getRootAlias().'.statut = ?', $value);
  } 
}
