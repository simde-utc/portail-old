<?php

/**
 * Profile form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfileFormIdentite extends BaseProfileForm
{

  public function configure()
  {
      $years =range(date('Y') - 40, date('Y') -12);
      $years_list = array_combine($years, $years);
      
      $this->widgetSchema['birthday']->setOption('years',$years_list);
      $this->widgetSchema['birthday']->setOption('format', '%day%/%month%/%year%');
      
     $this->widgetSchema['birthday']->setAttributes(array(
      'date' => array('class' => 'nosize')
     ));
     
     $this->widgetSchema->setLabel('birthday', '<b>Date de Naissance</b>');
     $this->widgetSchema->setLabel('sexe', '<b>Sexe</b>');
     
     $this->embedRelation('Branche');
     $this->embedRelation('Filiere');
     
     $sex = array('M' => 'Homme', 'F' => 'Femme');
     $this->widgetSchema['sexe'] = new sfWidgetFormSelectRadio(array('choices' => $sex)); 
     
     $this->useFields(array("id","birthday","sexe","branche_id","filiere_id"));
      
  }

}