<?php

/**
 * charte_locaux module configuration.
 *
 * @package    simde
 * @subpackage charte_locaux
 * @author     Your name here
 * @version    SVN: $Id: configuration.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class charte_locauxGeneratorConfiguration extends BaseCharte_locauxGeneratorConfiguration
{
  public function getFilterDefaults()
  {  
    return array('statut' => 2); 
  }
}
