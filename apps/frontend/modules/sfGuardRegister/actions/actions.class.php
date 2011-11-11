<?php

require_once(sfConfig::get('sf_plugins_dir').'/sfDoctrineGuardPlugin/modules/sfGuardRegister/lib/BasesfGuardRegisterActions.class.php');

/**
 * sfGuardRegister actions.
 *
 * @package    guard
 * @subpackage sfGuardRegister
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z jwage $
 */
class sfGuardRegisterActions extends BasesfGuardRegisterActions
{

  /**
   * Traite le formulaire d'inscription
   *
   * @param sfWebRequest $request
   */
  public function executeIndex(sfWebRequest $request)
  {
    if($this->getUser()->isAuthenticated())
    {
      $this->getUser()->setFlash('notice','You are already registered and signed in!');
      $this->redirect('@homepage');
    }

    $this->form = new sfGuardRegisterForm();

    if($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if($this->form->isValid())
      {
        $user = $this->form->save();
        $user->setIsActive(false);
        $user->save();
        $this->sendActivationMail($user);
      }
    }
  }

  /**
   * Réenvoie un mail d'activation si nécessaire.
   *
   * @param sfWebRequest $request
   */
  public function executeResend(sfWebRequest $request)
  {
    if(!$this->getUser()->isAuthenticated())
    {
      $this->getUser()->setFlash('error','Erreur d\'activation !');
      $this->redirect('@homepage');
    }

    $this->sendActivationMail($this->getUser()->getGuardUser());
  }

  public function sendActivationMail($user)
  {
    $activation = new Activation();
    $activation->setSfGuardUser($user);
    $key = sha1($user->getUsername().time());
    $activation->setActivationKey($key);
    $activation->save();

    $message = $this->getMailer()->composeAndSend(
      'bde-portail@emilienkenler.com',$user->getEmailAddress(),'Please confirm your registration!','Hello '.$user->getName().',
        Please click on the following link to complete your registration:
        '.$this->generateUrl('register_activation',array('activation_key' => $activation->getActivationKey()),true).'
        We hope you will have fun!');

    $this->getUser()->setFlash('notice','Un mail de confirmation vous a été envoyé !');
    $this->redirect('@homepage');
  }

  /**
   *
   * @param sfWebRequest $request
   */
  public function executeActivation(sfWebRequest $request)
  {
    $activation = $this->getRoute()->getObject();
    if(!$activation)
    {
      $user->setFlash('error','Erreur d\'activation !');
      $this->redirect('@homepage');
    }

    $user = $activation->getSfGuardUser();
    $user->setIsActive(true);
    $user->save();
    $activation->delete();
    $this->getUser()->setFlash('notice','Votre compte a été activé !');
    $this->redirect('@homepage');
  }

}