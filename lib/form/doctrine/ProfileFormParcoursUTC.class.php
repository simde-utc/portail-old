<?php

/**
 * Profile form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfileFormParcoursUTC extends BaseProfileForm
{

  public function configure()
  {
      $years =range(date('Y') - 40, date('Y') -12);
      $years_list = array_combine($years, $years);
      
      $this->widgetSchema['birthday']->addOption('date', array(
      'years' => $years_list
     ));
      
     $this->widgetSchema['birthday']->setAttributes(array(
      'date' => array('class' => 'nosize')
     ));
     
     $this->widgetSchema->setLabel('birthday', '<b>Date de Naissance</b>');
      
      $this->useFields(array("id","birthday"));
      
  }

}