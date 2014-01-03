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
      'event_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Event'), 'add_empty' => false)),
      'title'       => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea()
    ));
    // $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
    //             'file_src' => doThumb($this->getObject()->getImage(), 'articles', array('width'=>150, 'height'=>150), 'scale'),
    //             'is_image' => true,
    //             'edit_mode' => (!$this->isNew() && $this->getObject()->getImage()),
    //             'with_delete' => true,
    //             'delete_label' => "Supprimer cette illustration"
    //         ));

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


  }

  public function processValues($values){
    
  }
  
}

