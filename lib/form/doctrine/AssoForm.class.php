<?php

/**
 * Asso form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AssoForm extends BaseAssoForm
{
  public function configure()
  {
    sfProjectConfiguration::getActive()->loadHelpers(array('Asset', 'Thumb'));
    $this->useFields(array(
        'name', 'pole_id','type_id','logo','summary','description','salle','phone','facebook'
    ));
    
    $this->widgetSchema['logo'] = new sfWidgetFormInputFileEditable(array(
      'file_src' => doThumb($this->getObject()->getLogo(), 'assos', array('width'=>150, 'height'=>150), 'scale'),
      'is_image' => true,
      'edit_mode' => (!$this->isNew() && $this->getObject()->getLogo()),
      'with_delete' => true,
      'delete_label' => "Supprimer ce logo",
    ));
 
    $this->validatorSchema['logo'] = new sfValidatorFileImage(array(
    	'required' => false,
    	'path' => sfConfig::get('sf_upload_dir').'/assos/source',
        'mime_types' => 'web_images',
        'max_width' => 1000,
        'max_height' => 1000
    ));
    
    $this->validatorSchema['logo_delete'] = new sfValidatorBoolean();
    
    $this->widgetSchema->setLabel('name', 'Nom');
    $this->widgetSchema->setLabel('pole_id', 'Pôle');
    $this->widgetSchema->setLabel('type_id', 'Structure');
    $this->widgetSchema->setLabel('summary', "L'assos en une ligne");
    $this->widgetSchema->setLabel('salle', 'Local');
    $this->widgetSchema->setLabel('phone', 'Téléphone');
    $this->widgetSchema->setLabel('facebook', 'Page Facebook');
    
    $this->getWidget('pole_id')->setOption('query',PoleTable::getInstance()->getAllWithInfos());
  }
}
