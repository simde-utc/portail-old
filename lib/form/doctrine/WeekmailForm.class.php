<?php

/**
 * Weekmail form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class WeekmailForm extends BaseWeekmailForm {

    public function configure() {
        unset($this['created_at'], $this['updated_at']);
        if ($this->getObject()->isNew()) {
            unset($this['published_at']);
        } else {
            $this->widgetSchema['published_at']->setLabel('Publication');
            $this->widgetSchema['published_at']->addOption('format', '%day%/%month%/%year%');
            $this->widgetSchema['published_at']->setDefault(date("d/m/Y"));
        }
    }

}
