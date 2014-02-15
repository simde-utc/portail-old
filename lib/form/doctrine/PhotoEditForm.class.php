<?php

/**
 * Photo form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PhotoEditForm extends BasePhotoForm
{
  public function configure()
  {
    $this->disableLocalCSRFProtection();
    
  	$this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'title'           => new sfWidgetFormInputText(array('default' => 'Ajouter un titre')),
      'is_public'       => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'           => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'is_public'       => new sfValidatorBoolean(),
    ));

    $this->widgetSchema->setLabel('title', 'Titre');
    $this->widgetSchema->setLabel('is_public', "Visible des étudiants non UTCéens");
    $this->widgetSchema->setNameFormat('photo[%s]');
    
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    $this->useFields(array('id', 'title', 'is_public'));
  }
}

