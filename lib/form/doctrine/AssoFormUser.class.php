<?php

/**
 * Asso form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AssoFormUser extends AssoForm
{
  public function configure()
  {
    parent::configure();
    
    $this->useFields(array(
        'name', 'pole_id','type_id','logo','summary','description','salle','phone','facebook','joignable'
    ));
  }
}
