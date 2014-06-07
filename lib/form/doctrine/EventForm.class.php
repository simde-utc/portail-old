<?php

/**
 * Event form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EventForm extends BaseEventForm
{
  public function getJavascripts(){
    return array('select2.js', 'select2_locale_fr.js', 'jquery-ui-1.8.12.custom.min.js',
      'jquery-ui-timepicker-addon.js');
  }

  public function getStylesheets(){
    return array('select2/select2.css'=>'screen', 'jquery-ui-1.8.12.custom.css' => 'screen');
  }

  public function configure()
  { 
    sfProjectConfiguration::getActive()->loadHelpers(array('Asset', 'Thumb'));
    
    $this->widgetSchema['asso_id'] = new sfWidgetFormInputHidden();
    
    $this->widgetSchema['start_date'] = new sfWidgetDatePicker();
    $this->validatorSchema['start_date'] = new sfValidatorDatePicker(array());
    
    $this->widgetSchema['end_date'] = new sfWidgetDatePicker();
    $this->validatorSchema['end_date'] = new sfValidatorDatePicker(array());
    
    $this->widgetSchema['affiche'] = new sfWidgetFormInputFileEditable(array(
      'file_src' => doThumb($this->getObject()->getAffiche(), 'events',
        array('width'=>150, 'height'=>150), 'scale'),
      'is_image' => true,
      'edit_mode' => (!$this->isNew() && $this->getObject()->getAffiche()),
      'with_delete' => true,
      'delete_label' => "Supprimer cette illustration",
    ));
 
    $this->validatorSchema['affiche'] = new sfValidatorFileImage(array(
    	'required' => false,
    	'path' => sfConfig::get('sf_upload_dir').'/events/source',
        'mime_types' => 'web_images',
        'max_width' => 1000,
        'max_height' => 1000
    ));
    
    $this->widgetSchema['guest_asso_list']->setOption('method', 'getName');
    
    $this->widgetSchema->setLabel('guest_asso_list', 'Associations Partenaires');
    $this->widgetSchema['guest_asso_list']->setAttributes(
      array('style' => 'width:100%;', 'class' => 'select2'));



    $this->validatorSchema['affiche_delete'] = new sfValidatorBoolean();

    $this->widgetSchema->setLabel('name', 'Nom');
    $this->widgetSchema->setLabel('type_id', 'Type');
    $this->widgetSchema->setLabel('start_date', 'Début');
    $this->widgetSchema->setLabel('end_date', 'Fin');
    $this->widgetSchema->setLabel('summary', 'Résumé en une ligne');
    $this->widgetSchema->setLabel('description', 'Description');
    $this->widgetSchema->setLabel('place', 'Lieu');
    $this->widgetSchema->setLabel('is_public', 'Ouvert au public ?');
    $this->widgetSchema->setLabel('affiche', 'Illustration');
    $this->widgetSchema->setLabel('is_weekmail', 'Paraître dans le Weekmail ?');
    $this->widgetSchema['is_weekmail']->setAttribute('style', 'width: 15px;');
    
    $this->useFields(array('asso_id', 'name', 'type_id', 'start_date', 'end_date',
      'summary', 'description', 'place', 'is_public', 'affiche', 'is_weekmail',
      'guest_asso_list'));
  }
}
