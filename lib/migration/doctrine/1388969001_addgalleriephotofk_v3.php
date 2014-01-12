<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addgalleriephotofk_v3 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('galerie_photo', 'galerie_photo_id_event_id', array(
             'name' => 'galerie_photo_id_event_id',
             'local' => 'id',
             'foreign' => 'id',
             'foreignTable' => 'event',
             ));
        $this->createForeignKey('photo', 'photo_id_galerie_photo_id', array(
             'name' => 'photo_id_galerie_photo_id',
             'local' => 'id',
             'foreign' => 'id',
             'foreignTable' => 'galerie_photo',
             ));
        $this->addIndex('galerie_photo', 'galerie_photo_id', array(
             'fields' => 
             array(
              0 => 'id',
             ),
             ));
        $this->addIndex('photo', 'photo_id', array(
             'fields' => 
             array(
              0 => 'id',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('galerie_photo', 'galerie_photo_id_event_id');
        $this->dropForeignKey('photo', 'photo_id_galerie_photo_id');
        $this->removeIndex('galerie_photo', 'galerie_photo_id', array(
             'fields' => 
             array(
              0 => 'id',
             ),
             ));
        $this->removeIndex('photo', 'photo_id', array(
             'fields' => 
             array(
              0 => 'id',
             ),
             ));
    }
}