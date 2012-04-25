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
    $this->useFields(array(
        'name', 'pole_id','type_id','logo','summary','description','salle','phone','facebook'
    ));
    
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
