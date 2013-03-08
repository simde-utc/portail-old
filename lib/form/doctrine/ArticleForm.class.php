<?php

/**
 * Article form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ArticleForm extends BaseArticleForm {

  public function configure() {
    sfProjectConfiguration::getActive()->loadHelpers(array('Asset', 'Thumb'));
    
    $this->widgetSchema['asso_id'] = new sfWidgetFormInputHidden();

    $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
                'file_src' => doThumb($this->getObject()->getImage(), 'articles', array('width'=>150, 'height'=>150), 'scale'),
                'is_image' => true,
                'edit_mode' => (!$this->isNew() && $this->getObject()->getImage()),
                'with_delete' => true,
                'delete_label' => "Supprimer cette illustration"
            ));
    
    $this->widgetSchema['text'] = new sfWidgetFormTextarea(array(), array('rows' => '20'));

    $this->validatorSchema['image'] = new sfValidatorFileImage(array(
    	'required' => false,
    	'path' => sfConfig::get('sf_upload_dir').'/articles/source',
        'mime_types' => 'web_images',
        'max_width' => 1000,
        'max_height' => 1000
    ));

    $this->validatorSchema['image_delete'] = new sfValidatorBoolean();
    
    $this->widgetSchema->setLabel('name', 'Titre');
    $this->widgetSchema->setLabel('text', 'Contenu');
    $this->widgetSchema->setLabel('image', 'Illustration');
    $this->useFields(array('asso_id', 'name', 'text', 'image'));
  }

}
