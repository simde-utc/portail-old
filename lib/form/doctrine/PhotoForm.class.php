<?php

/**
 * Photo form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PhotoForm extends BasePhotoForm
{
  public function configure()
  {
  	sfProjectConfiguration::getActive()->loadHelpers(array('Asset', 'Thumb'));

    $this->disableLocalCSRFProtection();


  	$this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'galeriePhoto_id' => new sfWidgetFormInputHidden(),
      'title'           => new sfWidgetFormInputHidden(),
      'author'          => new sfWidgetFormInputHidden(),
      'is_public'       => new sfWidgetFormInputCheckbox(array('default' => false)),
    ));

    $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
        'file_src' => doThumb($this->getObject()->getImage(), 'galeries', array('width'=>150, 'height'=>150), 'scale'),
        'is_image' => true,
        'edit_mode' => (!$this->isNew() && $this->getObject()->getImage()),
        'with_delete' => true,
        'delete_label' => "Supprimer cette photo"
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'galeriePhoto_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('GaleriePhoto'))),
      'title'           => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'author'          => new sfValidatorInteger(),
      'is_public'       => new sfValidatorBoolean(),
    ));

    $this->validatorSchema['image'] = new sfValidatorFileImage(array(
    	'required' => false,
    	'path' => sfConfig::get('sf_upload_dir').'/galeries/source',
        'mime_types' => 'web_images',
        'max_width' => 2048,
        'max_height' => 2048
    ));


    $this->widgetSchema->setLabel('title', 'Titre');
    $this->widgetSchema->setLabel('author', 'Photographe');
    $this->widgetSchema->setLabel('is_public', "Est publique");
    $this->widgetSchema->setNameFormat('photo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    $this->useFields(array('galeriePhoto_id', 'title', 'author', 'is_public', 'image'));
  }

  public function getJavaScripts() {
    return array(
      'jquery.fineuploader-4.1.1.min.js'
    );
  }

  public function getStylesheets() {
    return array(
      'fineuploader-4.1.1.min.css' => 'screen'
    );
  }

  public function getErrors()
  {
   $errors = array();

   // individual widget errors
   foreach ($this as $form_field)
   {   
     if ($form_field->hasError())
     {   
       $error_obj = $form_field->getError();
       if ($error_obj instanceof sfValidatorErrorSchema)
       {   
         foreach ($error_obj->getErrors() as $error)
         {   
           // if a field has more than 1 error, it'll be over-written
           $errors[$form_field->getName()] = $error->getMessage();
         }   
       }   
       else
       {   
         $errors[$form_field->getName()] = $error_obj->getMessage();
       }   
     }   
   }   

   // global errors
   foreach ($this->getGlobalErrors() as $validator_error)
   {   
     $errors[] = $validator_error->getMessage();
   }   

   return $errors;
  }
}
