<?php

/**
 * GaleriePhoto form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GaleriePhotoForm extends BaseGaleriePhotoForm
{
  public function configure() {

  	sfProjectConfiguration::getActive()->loadHelpers(array('Asset', 'Thumb'));
  	$this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'event_id'    => new sfWidgetFormInputHidden(),
      'title'       => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea()
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'event_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Event'))),
      'title'       => new sfValidatorString(array('max_length' => 200)),
      'description' => new sfValidatorString()
    ));


    $this->widgetSchema->setLabel('event_id', 'Evènement');
    $this->widgetSchema->setLabel('title', 'Titre');

    $this->widgetSchema->setNameFormat('galerie[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    $this->useFields(array('event_id', 'title', 'description'));


  }

  
}

