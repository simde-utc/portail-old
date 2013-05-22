<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addemprunt extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('emprunt', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => 8,
              'autoincrement' => true,
              'primary' => true,
             ),
             'materiel_id' => 
             array(
              'type' => 'integer',
              'length' => 8,
             ),
             'user_id' => 
             array(
              'type' => 'integer',
              'length' => 8,
             ),
             'asso_id' => 
             array(
              'type' => 'integer',
              'length' => 8,
             ),
             'nombre' => 
             array(
              'type' => 'integer',
              'length' => 8,
             ),
             'recu' => 
             array(
              'type' => 'boolean',
              'length' => 25,
             ),
             'rendu' => 
             array(
              'type' => 'boolean',
              'length' => 25,
             ),
             'created_at' => 
             array(
              'notnull' => true,
              'type' => 'timestamp',
              'length' => 25,
             ),
             'updated_at' => 
             array(
              'notnull' => true,
              'type' => 'timestamp',
              'length' => 25,
             ),
             ), array(
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'id',
             ),
             'collate' => 'utf8_unicode_ci',
             'charset' => 'utf8',
             ));
    }

    public function down()
    {
        $this->dropTable('emprunt');
    }
}