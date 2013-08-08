<?php

class Updateservice extends Doctrine_Migration_Base
{
  public function up()
  {
    $this->changeColumn('service', 'nom', 'string', 100);
    $this->changeColumn('service', 'logo', 'string', 255);
    $this->changeColumn('service', 'url', 'string', 255);
  }

  public function down()
  {
  }
}
