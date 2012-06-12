<?php

/**
 * Annonce filter form.
 *
 * @package    simde
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AnnonceFormFilter extends BaseAnnonceFormFilter
{

  public function configure()
  {
    $this->widgetSchema['ville']->setOption('with_empty', false);
    $this->widgetSchema['debut']->setOption('with_empty', false);
    $this->widgetSchema['fin']->setOption('with_empty', false);
    unset($this['created_at'], $this['updated_at'], $this['email'], $this['password'], $this['user_id'], $this['texte'], $this['titre'], $this['offre'],$this['debut'],$this['fin']);
  }

}
