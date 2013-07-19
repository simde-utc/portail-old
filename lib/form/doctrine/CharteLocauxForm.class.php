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
      $this->setDefault('semestre_id', sfConfig::get('app_portail_current_semestre'));
      unset(
      $this['ip'], $this['date'], $this['semestre_id'], $this['created_at'], $this['updated_at'],
      $this['login'], $this['user_id'], $this['statut']
      );
      
      

  }
  
}
