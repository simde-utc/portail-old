<?php

class Doctrine_Template_Gallerify extends Doctrine_Template {

    /** Array of Gallerify options */
    protected $_options = array(
        'gallery_id' => array('name' => 'gallery_id',
            'alias' => null,
            'type' => 'integer',
            'disabled' => false,
            'expression' => false,
            'options' => array('notnull' => false)),
        );

    /**
     * Set table definition for Gallerify behavior
     *
     * @return void
     */
    public function setTableDefinition() {
        if (!$this->_options['gallery_id']['disabled']) {
            $name = $this->_options['gallery_id']['name'];
            if ($this->_options['gallery_id']['alias']) {
                $name .= ' as ' . $this->_options['gallery_id']['alias'];
            }
            $this->hasColumn($name, $this->_options['gallery_id']['type'], null, $this->_options['gallery_id']['options']);
        }

        $this->addListener(new Doctrine_Template_Listener_Gallerify($this->_options));
    }
    
    public function setUp()
    {
        $this->hasOne('Gallery as Gallery', array(
                'local' => $this->_options['gallery_id']['name'],
                'foreign' => 'id',
                'onDelete'=>'SET NULL'
            )
        );
    }

}