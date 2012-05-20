<?php

/**
 * AssoMember form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AssoMemberEditForm extends AssoMemberForm
{
  public function configure()
  {
    parent::configure();
    unset($this['semestre_id'],$this['asso_id'],$this['user_id']);
  }
}
