<?php

/**
 * sfWidgetFormJQueryFileUpload represents an upload HTML input tag with the possibility
 * to upload several files
 *
 * @package    gallerynePlugin
 * @subpackage widget
 * @author     Leny Bernard <leny.bernard@gmail.com>
 * @version    GIT: $Id: sfWidgetFormJQueryFileUpload.class.php 30762 2011-08-229 17:38:33Z leny $
 */
class sfWidgetFormJQueryFileUpload extends sfWidgetFormInput {

    /**
     * Constructor.
     *
     * Available options:
     *
     * @param array $options     An array of options
            parent_id
            upload_method
            upload_config
            callback
            with_default
            with_meta
            file_types
            help_message_1
            help_message_2
            button_label
            uploaderTemplate
            btn_template
     * @param array $attributes  An array of default HTML attributes
     *
     * @see sfWidgetFormInput
     */
    protected function configure($options = array(), $attributes = array()) {
        parent::configure($options, $attributes);

        $this->addOption('parent_id','null');
        $this->addOption('upload_method', null);
        $this->addOption('upload_config', 'default');
        $this->addOption('callback', 'uploader/list');
        $this->addOption('with_default', 0);
        $this->addOption('with_meta', 0);
        $this->addOption('file_types', null);
        $this->addOption('actions', array());
        $this->addOption('help_message_1',null);
        $this->addOption('help_message_2',null);
        $this->addOption('button_label', "Upload");
        $this->addOption('uploaderTemplate', 'uploader/fileUploaderTemplate');
        $this->addOption('btn_template',"uploader/uploaderButtonTemplate");
}

    public function getStylesheets() {
        return array(
            "/gallerynePlugin/css/fileuploader.css" => "all",
        );
    }

    public function getJavaScripts() {
        return array(
            "/gallerynePlugin/js/fileuploader.js"
        );
    }

    /**
     * Renders the widget.
     *
     * @param  string $name        The element name
     * @param  string $value       The value displayed in this widget
     * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
     * @param  array  $errors      An array of errors for the field
     *
     * @return string An HTML tag string
     *
     * @see sfWidgetForm
     */
    public function render($name, $value = null, $attributes = array(), $errors = array()) {

        $file_types = $this->getOption('file_types') ? implode(",", $this->getOption('file_types')) : "all";
        if (!$this->getOption("callback")) {
            $callbackUrl = sfContext::getInstance()->getRouting()->generate(
                "uploader_list");
        }else{
            $callbackUrl = $this->getOption("callback");
        }

        if (!$this->getOption("upload_method")) {
            $uploadUrl = sfContext::getInstance()->getRouting()->generate(
                "uploader_upload");
        }else{
            $uploadUrl = $this->getOption("upload_method");
        }
        
        $upload_config = sfConfig::get("app_uploader_upload_config");
        $render = include_partial($this->getOption('uploaderTemplate'), array(
            "upload_config" => $this->getOption('upload_config'),
            "parent_id" => $this->getOption('parent_id'),
            "button_label" => $this->getOption('button_label'),
            "actions" => $this->getOption('actions'),
            "with_default" => $this->getOption('with_default'),
            "with_meta" => $this->getOption('with_meta'),
            "file_types" => $file_types,
            "id" => $this->generateId($name),
            "name" => $name,
            "value" => $value,
            "upload_method" => $uploadUrl,
            "callback" => $callbackUrl,
            "btn_template" => $this->getOption('btn_template'),
            "help_message1" => $this->getOption('help_message_1'),
            "help_message2" => $this->getOption('help_message_2'),
            ));
        return strtr($render, null, null);
    }

}
