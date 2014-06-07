<?php

class Updategalleriephotofk extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->dropForeignKey('galerie_photo', 'galerie_photo_event_id_event_id');
        $this->dropForeignKey('photo', 'photo_galeriephoto_id_galerie_photo_id');
        $this->dropForeignKey('photo', 'photo_author_sf_guard_user_id');
        $this->createForeignKey('galerie_photo', 'galerie_photo_event_id_event_id', array(
            'name' => 'galerie_photo_event_id_event_id',
            'local' => 'event_id',
            'foreign' => 'id',
            'foreignTable' => 'event',
            'onDelete' => 'CASCADE',
            ));
        $this->createForeignKey('photo', 'photo_galeriephoto_id_galerie_photo_id', array(
            'name' => 'photo_galeriephoto_id_galerie_photo_id',
            'local' => 'galeriephoto_id',
            'foreign' => 'id',
            'foreignTable' => 'galerie_photo',
            'onDelete' => 'CASCADE',
            ));
        $this->createForeignKey('photo', 'photo_author_sf_guard_user_id', array(
            'name' => 'photo_author_sf_guard_user_id',
            'local' => 'author',
            'foreign' => 'id',
            'foreignTable' => 'sf_guard_user',
            'onDelete' => 'CASCADE',
            ));
    }

    public function down()
    {
        $this->dropForeignKey('galerie_photo', 'galerie_photo_event_id_event_id');
        $this->dropForeignKey('photo', 'photo_galeriephoto_id_galerie_photo_id');
        $this->dropForeignKey('photo', 'photo_author_sf_guard_user_id');
        $this->createForeignKey('galerie_photo', 'galerie_photo_event_id_event_id', array(
            'name' => 'galerie_photo_event_id_event_id',
            'local' => 'event_id',
            'foreign' => 'id',
            'foreignTable' => 'event',
            ));
        $this->createForeignKey('photo', 'photo_galeriephoto_id_galerie_photo_id', array(
            'name' => 'photo_galeriephoto_id_galerie_photo_id',
            'local' => 'galeriephoto_id',
            'foreign' => 'id',
            'foreignTable' => 'galerie_photo',
            ));
        $this->createForeignKey('photo', 'photo_author_sf_guard_user_id', array(
            'name' => 'photo_author_sf_guard_user_id',
            'local' => 'author',
            'foreign' => 'id',
            'foreignTable' => 'sf_guard_user',
            ));
    }
}
