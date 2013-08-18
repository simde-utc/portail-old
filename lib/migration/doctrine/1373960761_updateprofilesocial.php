<?php

class Updateprofilesocial extends Doctrine_Migration_Base
{
  public function up()
  {
    $this->addColumn('profile', 'devise', 'string', '255');
  }

  public function down()
  {
    $this->removeColumn('progile', 'devise');
  }
}
