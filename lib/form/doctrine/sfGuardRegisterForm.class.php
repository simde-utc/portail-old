<?php

/**
 * sfGuardRegisterForm for registering new users
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: BasesfGuardChangeUserPasswordForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardRegisterForm extends BasesfGuardRegisterForm
{
  /**
   * @see sfForm
   */
  public function configure()
  {
    parent::configure();
    $profileForm = new ProfileForm($this->object->Profile);
    unset($profileForm['id'],$profileForm['user_id']);
    unset($profileForm['nickname'],$profileForm['birthday'],$profileForm['sexe'],$profileForm['mobile'],$profileForm['home_place'],$profileForm['family_place']);
    $this->embedForm('Profile',$profileForm);
  }
}