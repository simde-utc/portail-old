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
        'name','pole_id','type_id','url_site','logo','summary','description','salle','phone','facebook'
    ));
    
    
    $this->getWidget('pole_id')->setOption('query',PoleTable::getInstance()->getAllWithInfos());
  }
}
