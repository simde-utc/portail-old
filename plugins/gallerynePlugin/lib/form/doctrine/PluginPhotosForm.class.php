<?php

/**
 * PluginPhotos form.
 *
 * @package    gallerynePlugin
 * @subpackage form
 * @author     leny
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginPhotosForm extends BasePhotosForm
{

      public function setup()
      {
        parent::setup();
        $this->removeFields();
        $i18n = sfContext::getInstance()->getI18N();
        $this->widgetSchema->setLabels(array(
                    'title' => $i18n->__("backend.photo.input.title.label", array(), "galleryne").' :',
                    'filename' => $i18n->__("backend.photo.input.path.label", array(), "galleryne").' <em>*</em>:',
        ));
        $path_gallery = sfConfig::get("app_gallerynePlugin_path_gallery").$this->getObject()->getGalleryId()."/";
        $default_size = sfConfig::get("app_gallerynePlugin_default_size");
        $this->widgetSchema['filename'] = new sfWidgetFormInputFileEditable(array(
                        'label'     => $i18n->__("backend.photo.input.path.label", array(), "galleryne").' :',
                        'file_src'  => $this->getObject()->getFullPath(true,$default_size),
                        'is_image'  => true,
                        'edit_mode' => !$this->isNew(),
                        'template'  => '<div>%file%<br />%input%<br />%delete% %delete_label%</div>',
        ));

	$this->setValidator('filename', new sfValidatorFile(array(
                              'required' => true,
                              'path' => $path_gallery."tmp/",
                              'mime_types' => 'web_images'
                        ), array(
                        )));

        $this->disableCSRFProtection();
    }

    protected function removeFields() {
        unset(
                $this['created_at'], $this['updated_at']
        );
    }

    public function generateFilenameFilename(sfValidatedFile $file) {
        return $file->getOriginalName();
    }
}
