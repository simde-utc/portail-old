<?php
/*
 * Description of avGalleryneAction
 *
 * @author leny
 */
class avGalleryneAction {
    private $icon;
    private $params;
    private $asynchronous;
    private $title;
    private $name;
    private $view;
    
    /* SETTERS */
    public function setIcon($icon) {
        $this->icon = $icon;
    }

    /**
     * The params are all the params which will be posted to the action url
     * @param array $params 
     */
    public function setParams(array $params) {
        $this->params = $params;
    }

    /**
     * set true to use ajax mode, false to not
     * @param boolean $value 
     */
    public function setAsynchronous($value) {
        $this->asynchronous = $value;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setName($name) {
        $this->name = $name;
    }
    /* GETTERS */
    public function getIcon() {
        return $this->icon;
    }

    public function getParams() {
        return $this->params;
    }

    public function getView() {
        return $this->params['module']."/action";
    }

    /**
     *
     * @param boolean $value 
     */
    public function getAsynchronous() {
        return $this->asynchronous;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getName() {
        return $this->name;
    }
}

?>
