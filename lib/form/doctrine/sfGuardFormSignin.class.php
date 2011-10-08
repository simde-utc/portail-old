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
    $this->useFields(array('username','password','remember'));
    $this->getWidget('username')->setLabel('Login');
    $this->getWidget('password')->setLabel('Mot de passe');
    $this->getWidget('remember')->setLabel('Se souvenir de moi');
  }

}
