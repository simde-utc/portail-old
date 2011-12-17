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
    unset(
      $this['created_at'],$this['updated_at']
    );
    
    /*$this->widgetSchema['description'] =  new sfWidgetFormTextareaTinyMCE(
      array(
        'width'=>550,
        'height'=>350,
        'config'=>'theme_advanced_disable: "anchor,image,cleanup,help"',
        'theme'   =>  sfConfig::get('app_tinymce_theme','advanced'),
      ),
      array(
        'class'   =>  'tiny_mce'
      )
    );
    $js_path = '/js/tiny_mce/tiny_mce.js';
    sfContext::getInstance()->getResponse()->addJavascript($js_path);*/
    
    $this->widgetSchema['start_date'] = new sfWidgetFormJQueryDate(array('image'=>'/images/calendar.png', 'date_widget'=>$this->widgetSchema['start_date']));
    $this->widgetSchema['end_date'] = new sfWidgetFormJQueryDate(array('image'=>'/images/calendar.png', 'date_widget'=>$this->widgetSchema['end_date']));
	
	$this->widgetSchema['affiche'] = new sfWidgetFormInputFileEditable(array(
      'file_src' => '/uploads/events/'.$this->getObject()->getAffiche(),
      'is_image' => true,
      'edit_mode' => !$this->isNew(),
      'with_delete' => true,
    ));
 
    $this->validatorSchema['affiche'] = new sfValidatorFile(array(
    	'required' => false,
    	'path' => sfConfig::get('sf_upload_dir').'/events',
        'mime_types' => 'web_images'
    ));
    
    $this->validatorSchema['affiche_delete'] = new sfValidatorBoolean();
  }
}
