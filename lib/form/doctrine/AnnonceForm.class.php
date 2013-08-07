<?php

/**
 * Annonce form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AnnonceForm extends BaseAnnonceForm {

  public function configure()
  {
    $this->widgetSchema['offre'] = new sfWidgetFormSelectRadio(array(
            'choices' => array(
                true => 'Je propose',
                false => 'Je cherche'
            ),
            'separator' => ' - ',
            'formatter' => array($this, "formatRadioList"),
        ));

    $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
    unset($this['created_at'], $this['updated_at']);

    $this->widgetSchema['password'] = new sfWidgetFormInputHidden();

    $this->validatorSchema->setPostValidator(
        new sfValidatorCallback(array('callback' => array($this, 'checkPassword')))
    );
  }

  public function checkPassword($validator, $values)
  {
    if(!isset($values['user_id']) || empty($values['user_id']))
    {
      if(!isset($values['email']) || empty($values['email']))
        throw new sfValidatorError($validator, 'Vous devez saisir une adresse email.');
    }
    // password is correct, return the clean values
    return $values;
  }

  public function setDefaultUser($user_id)
  {
    $this->setDefault('user_id', $user_id);
    $this->widgetSchema['email'] = new sfWidgetFormInputHidden();
  }

  public function formatRadioList($widget, $inputs)
  {
    $rows = array();
    foreach($inputs as $input)
    {
      $rows[] = $input['input'] . $this->getOption('label_separator') . $input['label'];
    }

    return implode($this->getOption('separator'), $rows);
  }

}
