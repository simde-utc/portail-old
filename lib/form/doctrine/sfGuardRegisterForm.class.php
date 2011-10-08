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
		$choices = array(
     0 => 'Etudiant UTC',
     1 => 'Enseignant UTC',
     2 => 'ESCOM',
     3 => 'Ancien',
     4 => 'Extérieur',
    );

    parent::configure();

		$this->widgetSchema['domain'] = new sfWidgetDomainSelector();
		$this->widgetSchema['username']->setAttribute('onkeyup', '$("#nickname_email").val($(this).val());');

		$this->widgetSchema->moveField('username', 'first');
		$this->widgetSchema->moveField('domain', 'after', 'username');

		$this->widgetSchema->setLabels(array(
		  'domain'   => 'Mail UTC',
		  'password' => 'Mot de passe',
		  'password_again' => 'Confirmer',
			'username'    => 'Login UTC',
			'last_name' => 'Nom',
			'first_name' => 'Prénom',
		));
	
  }
}