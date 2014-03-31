<?php

class AddsfguarduserV2 extends Doctrine_Migration_Base
{
  public function up()
  {
    $this->addColumn('sf_guard_user', 'is_cotisant', BOOLEAN);
  }

  public function down()
  {
    $this->removeColumn('sf_guard_user','is_cotisant');
  }
}
