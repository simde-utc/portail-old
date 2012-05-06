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
  public function configure()
  { 
    sfProjectConfiguration::getActive()->loadHelpers(array('Asset', 'Thumb'));
    
    $this->getWidget('asso_id')->setOption('query', AssoTable::getInstance()->getMyAssos(sfContext::getInstance()->getUser()->getGuardUser()->getId()));
    $this->getValidator('asso_id')->setOption('query', AssoTable::getInstance()->getMyAssos(sfContext::getInstance()->getUser()->getGuardUser()->getId()));
    
    /*$this->widgetSchema['start_date'] = new sfWidgetFormJQueryDate(array('image'=>'/images/calendar.png', 'date_widget'=>$this->widgetSchema['start_date']),
      array('time'=>array('class'=>'nosize'), 'date'=>array('class'=>'nosize')));
    $this->widgetSchema['end_date'] = new sfWidgetFormJQueryDate(array('image'=>'/images/calendar.png', 'date_widget'=>$this->widgetSchema['end_date']),
      array('time'=>array('class'=>'nosize'), 'date'=>array('class'=>'nosize')));*/
        
    $this->widgetSchema['start_date']->addOption('date', array(
      'format' => '%day%/%month%/%year%',
      'years' => range(date('Y'), date('Y') + 5)
     ));
    $this->widgetSchema['end_date']->addOption('date', array(
      'format' => '%day%/%month%/%year%',
      'years' => range(date('Y'), date('Y') + 5)
     ));

    
    $this->widgetSchema['start_date']->setAttributes(array(
      'date' => array('class' => 'nosize'),
      'time' => array('class' => 'nosize')
    ));
    $this->widgetSchema['end_date']->setAttributes(array(
      'date' => array('class' => 'nosize'),
      'time' => array('class' => 'nosize')
    ));
    
    $this->widgetSchema['affiche'] = new sfWidgetFormInputFileEditable(array(
      'file_src' => doThumb($this->getObject()->getAffiche(), 'events', array('width'=>150, 'height'=>150), 'scale'),
      'is_image' => true,
      'edit_mode' => (!$this->isNew() && $this->getObject()->getAffiche()),
      'with_delete' => true,
      'delete_label' => "Supprimer cette illustration",
    ));
 
    $this->validatorSchema['affiche'] = new sfValidatorFile(array(
    	'required' => false,
    	'path' => sfConfig::get('sf_upload_dir').'/events/source',
        'mime_types' => 'web_images'
    ));
    
    $this->validatorSchema['affiche_delete'] = new sfValidatorBoolean();

    $this->widgetSchema->setLabels(array(
        'asso_id' => 'Auteur',));
    $this->widgetSchema->setLabel('name', 'Nom');
    $this->widgetSchema->setLabel('type_id', 'Type');
    $this->widgetSchema->setLabel('start_date', 'Début');
    $this->widgetSchema->setLabel('end_date', 'Fin');
    $this->widgetSchema->setLabel('summary', 'Résumé en une ligne');
    $this->widgetSchema->setLabel('description', 'Description');
    $this->widgetSchema->setLabel('place', 'Lieu');
    $this->widgetSchema->setLabel('is_public', 'Ouvert au public ?');
    $this->widgetSchema->setLabel('affiche', 'Illustration');
    
    $this->useFields(array('asso_id', 'name', 'type_id', 'start_date', 'end_date', 'summary', 'description', 'place', 'is_public', 'affiche'));
  }
}
