<?php

/**
 * CharteLocaux form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CharteLocauxForm extends BaseCharteLocauxForm
{
  public function configure()
  { 
	  $this->widgetSchema['asso_id'] = new sfWidgetFormInputHidden();
	  $this->widgetSchema['ip'] = new sfWidgetFormInputHidden();
	  $this->widgetSchema['date'] = new sfWidgetFormInputHidden();
	  $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
	  $this->widgetSchema['statut'] = new sfWidgetFormInputHidden();
	  $this->widgetSchema['login'] = new sfWidgetFormInputHidden();
	  $this->widgetSchema['semestre_id'] = new sfWidgetFormInputHidden();
	  
	  unset( $this['created_at'], $this['updated_at'] );
  }
  
}
