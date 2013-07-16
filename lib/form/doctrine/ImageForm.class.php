<?php

/**
 * Image form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ImageForm extends BaseImageForm {
    public function configure() {
        unset($this['created_at'], $this['updated_at'], $this['album_id']);

        $this->setWidget('name', new sfWidgetFormInputFileEditable(array(
            'file_src' => '/uploads/albums/thumb/130x120_' . $this->getObject()->name, // le chemin modifié ici peut créer un header pb...
            'edit_mode' => !$this->isNew(),
            'is_image' => true,
            'with_delete' => true,
            'delete_label' => 'Supprimer',
            'template' => '<div>%file%<br />%input%<br />%delete% %delete_label%</div>',
        )));
        $this->validatorSchema['name'] = new sfValidatorFile(array(
            'required' => false,
            'path' => sfConfig::get('sf_upload_dir') . '/albums/source',
            'mime_types' => 'web_images',
            'max_size' => '60480000'
        ));
        //  $this->widgetSchema->setHelp('name', 'L\'image doit être au format image.' );
        $this->widgetSchema->setLabel('legend', 'Légende');
        $this->widgetSchema->setLabel('name', 'Image');

        $this->validatorSchema['name_delete'] = new sfValidatorBoolean();
        /*
          $this->setWidget('filename', new sfWidgetFormInputFile());
      $this->setValidator('filename', new sfValidatorFile(array(
        'mime_types' => 'web_images',
        'path' => sfConfig::get('sf_upload_dir').'/products',
      )));

      */
    }
}
