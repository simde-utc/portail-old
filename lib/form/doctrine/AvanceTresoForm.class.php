<?php

/**
 * AvanceTreso form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AvanceTresoForm extends BaseAvanceTresoForm
{
  public function configure()
  {
    $this->widgetSchema['commentaire']->setLabel('Raison');

    // virement possible à toutes les assos
    if ($this->getObject()->getAsso()->isNew()) {
        $add_empty = '- Choisis une asso -';
    } else {
        $add_empty = false;

        $this->widgetSchema['asso_compte_id'] = new sfWidgetFormDoctrineChoice(array(
          'model' => 'CompteBanquaire',
          'query' => CompteBanquaireTable::getInstance()->getAllForAsso($this->getObject()->getAsso()),
          'add_empty' => false,
          'label' => 'Compte Recepteur'
        ));
        $this->validatorSchema['asso_compte_id'] = new sfValidatorDoctrineChoice(array(
          'model' => 'CompteBanquaire',
          'query' => CompteBanquaireTable::getInstance()->getAllForAsso($this->getObject()->getAsso()),
        ));
    }
    $this->widgetSchema['asso_id'] = new sfWidgetFormDoctrineChoice(array(
          'model' => $this->getRelatedModelName('Asso'),
          'method' => 'getName',
          'key_method' => 'getLogin',
          'add_empty' => $add_empty,
          'label' => 'Destinataire'
    ));
    $this->setDefault('asso_id', $this->getObject()->getAsso()->getLogin());
    $this->validatorSchema['asso_id'] = new sfValidatorDoctrineChoice(array(
          'model' => $this->getRelatedModelName('Asso'),
          'column' => 'login'
    ));

    $this->widgetSchema['emetteur_compte_id'] = new sfWidgetFormDoctrineChoice(array(
      'model' => 'CompteBanquaire',
      'query' => CompteBanquaireTable::getInstance()->getAllForAsso($this->getObject()->getEmetteur()),
      'add_empty' => false,
      'label' => 'Compte Emetteur'
    ));
    $this->validatorSchema['emetteur_compte_id'] = new sfValidatorDoctrineChoice(array(
      'model' => 'CompteBanquaire',
      'query' => CompteBanquaireTable::getInstance()->getAllForAsso($this->getObject()->getEmetteur()),
    ));

    // montant, moyen de paiement et moyen_commentaire
    $this->widgetSchema['montant'] = new sfWidgetFormInputText();
    $this->validatorSchema['montant'] = new ValidatorNumberNotNull();
    $this->widgetSchema['moyen_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => 'TransactionMoyen',
            'add_empty' => false
    ));
    $this->validatorSchema['moyen_id'] = new sfValidatorDoctrineChoice(array(
            'model' => 'TransactionMoyen'
    ));
    $this->widgetSchema['moyen_commentaire'] = new sfWidgetFormTextarea();
    $this->validatorSchema['moyen_commentaire'] = new sfValidatorString(array('required' => false));

    $this->widgetSchema['emetteur_id'] = new sfWidgetFormInputHidden();
    unset($this['transaction_id'], $this['transaction_emetteur_id']);
  }

  /**
   * the missing set value function to change a default after the values are bound
   * @param string $field the name of the field
   * @param mixed $value the new value
   */
  public function setValue($field, $value) {
      $this->values[$field] = $value; // set the value for this request
      $this->taintedValues[$field] = $value; // override the value entered by the user
      $this->resetFormFields(); // force a refresh on the field schema
  }
}
