<?php

/**
 * Annonce form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AnnonceForm extends BaseAnnonceForm
{

  public function configure()
  {
    $this->widgetSchema['debut']->addOption('date', array(
        'format' => '%day%/%month%/%year%',
    ));
    $this->widgetSchema['fin']->addOption('date', array(
        'format' => '%day%/%month%/%year%',
    ));

    $this->widgetSchema['debut']->setAttributes(array(
        'date' => array('class' => 'nosize'),
        'time' => array('class' => 'nosize')
    ));
    $this->widgetSchema['fin']->setAttributes(array(
        'date' => array('class' => 'nosize'),
        'time' => array('class' => 'nosize')
    ));

    $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
    unset($this['created_at'], $this['updated_at']);


    $this->validatorSchema->setPostValidator(
            new sfValidatorCallback(array('callback' => array($this, 'checkPassword')))
    );
  }

  public function checkPassword($validator, $values)
  {
    if(!isset($values['user_id']) || empty($values['user_id']))
    {
      if(!isset($values['email']) || empty($values['email']) || !isset($values['password']) || empty($values['password']))
        throw new sfValidatorError($validator, 'Vous devez saisir une adresse email et un mot de passe.');
    }
    // password is correct, return the clean values
    return $values;
  }

  public function setDefaultUser($user_id)
  {
    $this->setDefault('user_id', $user_id);
    $this->widgetSchema['email'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['password'] = new sfWidgetFormInputHidden();
  }

}
