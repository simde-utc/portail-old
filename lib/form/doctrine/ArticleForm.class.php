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
    unset($this['created_at'], $this['updated_at'], $this['is_weekmail']);
    
    $this->getWidget('asso_id')->setOption('query', AssoTable::getInstance()->getMyAssos(sfContext::getInstance()->getUser()->getGuardUser()->getId()));
    $this->getValidator('asso_id')->setOption('query', AssoTable::getInstance()->getMyAssos(sfContext::getInstance()->getUser()->getGuardUser()->getId()));

    $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
                'file_src' => '/uploads/articles/' . $this->getObject()->getImage(),
                'is_image' => true,
                'edit_mode' => !$this->isNew(),
                'with_delete' => true,
            ));

    $this->validatorSchema['image'] = new sfValidatorFile(array(
                'required' => false,
                'path' => sfConfig::get('sf_upload_dir') . '/articles',
                'mime_types' => 'web_images'
            ));

    $this->validatorSchema['image_delete'] = new sfValidatorBoolean();
    
    $this->widgetSchema->setLabel('asso_id', 'Auteur');
    $this->widgetSchema->setLabel('name', 'Titre');
    $this->widgetSchema->setLabel('summary', 'Résumé en une ligne');
    $this->widgetSchema->setLabel('text', 'Contenu');
    $this->widgetSchema->setLabel('image', 'Ilustration');
    $this->useFields(array('asso_id', 'name', 'summary', 'text', 'image'));
  }

}
