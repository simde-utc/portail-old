<?php

/**
 * PluginGallery form.
 *
 * @package    gallerynePlugin
 * @subpackage form
 * @author     leny
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginGalleryForm extends BaseGalleryForm
{
  public function setup()
  {
        parent::setup();
        $this->removeFields();
	$this->widgetSchema['description'] = new sfWidgetFormTextarea(array(),array('cols'=>'150','rows'=>8));        
        
        $this->widgetSchema["photos"] = new sfWidgetFormJQueryFileUpload(
                array(
                    "parent_id" => $this->isNew() ? "null" : $this->getObject()->getId(),
                    "button_label" => "Ajoutez une photo",
                    "file_types" => array("Photos"),
                    "actions" => array(
                        "download",
                        "rotate.left",
                        "rotate.right",
                        "delete",
                        "flip.vertical",
                        "flip.horizontal"
                        ),
                    "with_meta"=>1,
                    "with_default"=>1
                )
            );
        $this->validatorSchema["photos"] = new sfValidatorPass();
        
  }

    protected function removeFields() {
        unset(
                $this['created_at'], $this['updated_at'], $this['slug']
        );
    }
}
