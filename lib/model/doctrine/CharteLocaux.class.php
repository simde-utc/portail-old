<?php

/**
 * CharteLocaux
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    simde
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class CharteLocaux extends BaseCharteLocaux
{
  public function getStatutString()
  {
    switch ($this->getStatut())
    {
      case 0: return "Charte non signée par l'étudiant"; break;

      case 1: return "Charte signée par l'étudiant"; break;

      case 2: return "Charte validée par le président"; break;

      case 3: return "Charte validée"; break;

      default: return "Charte invalide"; break;
    }
  }
}
