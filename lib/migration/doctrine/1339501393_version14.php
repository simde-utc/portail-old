<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version14 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('annonce', 'annonce_user_id_sf_guard_user_id', array(
             'name' => 'annonce_user_id_sf_guard_user_id',
             'local' => 'user_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
        $this->addIndex('annonce', 'annonce_user_id', array(
             'fields' => 
             array(
              0 => 'user_id',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('annonce', 'annonce_user_id_sf_guard_user_id');
        $this->removeIndex('annonce', 'annonce_user_id', array(
             'fields' => 
             array(
              0 => 'user_id',
             ),
             ));
    }
}