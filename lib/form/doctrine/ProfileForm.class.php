<?php

/**
 * Profile form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfileForm extends BaseProfileForm
{

  public function configure()
  {
    unset($this['updated_at'],$this['created_at']);
    $choices = array(
     0 => 'Etudiant UTC',
     1 => 'Enseignant UTC',
     2 => 'ESCOM',
     3 => 'Ancien',
     4 => 'Extérieur',
    );

    $this->widgetSchema['domain'] = new sfWidgetFormChoice(array('choices' => $choices));

    $this->validatorSchema['domain'] = new sfValidatorChoice(array('choices' => array_keys($choices),'required' => true));
  }

}
