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

    $this->useFields(array(
     'username','email_address','first_name','last_name','password','password_again','Profile'
    ));

    $array = array('nickname','birthday','sexe','mobile','home_place','family_place',
     'branche_id','filiere_id','semestre','other_email','photo','weekmail','autorisation_photo','cotisant');
    foreach($array as $row)
      unset($this->widgetSchema['Profile'][$row]);
    $this->getWidget('Profile')->setHidden(true);
    $this->widgetSchema['Profile']['domain'] = new sfWidgetFormInputHidden();
  }

  public function processValues($values)
  {
    return parent::processValues($values);
  }

}