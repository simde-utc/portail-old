<?php

/**
 * Image form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ImageForm extends BaseImageForm
{
  public function configure()
  {
       unset($this['created_at'], $this['updated_at'], $this['album_id']);
       
       /*
     $this->widgetSchema['asso_id'] = new sfWidgetFormInputHidden();

    $this->widgetSchema['name'] = new sfWidgetFormInputFileEditable(array(
                'file_src' => doThumb($this->getObject()->getImage(), 'albums', array('width'=>150, 'height'=>150), 'scale'),
                'is_image' => true,
                'edit_mode' => (!$this->isNew() && $this->getObject()->getImage()),
                'with_delete' => true,
                'delete_label' => "Supprimer cette image"
            ));

    $this->validatorSchema['name'] = new sfValidatorFile(array(
                'required' => false,
                'path' => sfConfig::get('sf_upload_dir') . '/albums/source' . $this->getObject()->getAlbumId(),
                'mime_types' => 'web_images'
            ));

    $this->validatorSchema['image_delete'] = new sfValidatorBoolean();
    
    
    */
       
  $this->setWidget('name', new sfWidgetFormInputFileEditable(array(
    'file_src'    => 'http://simde/uploads/albums/'.$this->getObject()->name, // le chemin modifié ici peut créer un header pb...
    'edit_mode'   => !$this->isNew(),
    'is_image'    => true,
    'with_delete' => true,
      'delete_label' => 'Supprimer'
  )));
    $this->validatorSchema['name'] = new sfValidatorFile(array(
                                        'required' => false,
                                        'path' => sfConfig::get('sf_upload_dir').'/albums',
                                        'mime_types' => 'web_images',
                                        'max_size' => '60480000'
                               ));
 //  $this->widgetSchema->setHelp('name', 'L\'image doit être au format image.' );
    $this->widgetSchema->setLabel('legend', 'Commentaire');
    $this->widgetSchema->setLabel('name', 'Image');
    
    /*
      $this->setWidget('filename', new sfWidgetFormInputFile());
  $this->setValidator('filename', new sfValidatorFile(array(
    'mime_types' => 'web_images',
    'path' => sfConfig::get('sf_upload_dir').'/products',
  )));
  
  */
  }
}
