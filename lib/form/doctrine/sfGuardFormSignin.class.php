<?php

/**
 * sfGuardFormSignin for sfGuardAuth signin action
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardFormSignin.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardFormSignin extends BasesfGuardFormSignin
{

  /**
   * @see sfForm
   */
  public function configure()
  {
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
