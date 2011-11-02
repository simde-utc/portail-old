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


    $this->widgetSchema['username']->setAttribute('onkeyup','$("#nickname_email").val($(this).val());');

    $choices = array(
     0 => 'Etudiant UTC',
     1 => 'Enseignant UTC',
     2 => 'ESCOM',
     3 => 'Ancien',
     4 => 'Extérieur',
    );
    $this->widgetSchema['email_address'] = new sfWidgetDomainSelector();

//    $this->validatorSchema['email_address'] = new sfValidatorChoice(array('choices' => array_keys($choices),'required' => true));

    $this->widgetSchema->setLabels(array(
     'email_address' => 'Mail UTC',
     'password' => 'Mot de passe',
     'password_again' => 'Confirmer',
     'username' => 'Login UTC',
     'last_name' => 'Nom',
     'first_name' => 'Prénom',
    ));

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
    $choices = array(
     '0' => 'etu.utc.fr',
//		 '' => 'hds.utc.fr',
     '1' => 'utc.fr',
     '2' => 'escom.fr',
//     3 => 'tremplin-utc.asso.fr',
//     4 => 'Autre...',
    );
    $values['Profile']['domain'] = $values['email_address'];
    $values['email_adress'] = $values['username'] . '@' . $choices[$values['email_address']];
    return parent::processValues($values);
  }

}