<?php

class UploadManager {

    public $upload_config;
    public $mediaObject;
    public $errors = array();

    function __construct($upload_config="default") {
        $fullConfig = sfConfig::get("app_gallerynePlugin_uploader");
        $this->upload_config = $fullConfig[$upload_config];
    }

    public function bind($file_types) {

        /* Get the file to upload, generate and feed the correct object */
        if ($file_types[0] == "all")
            $file_types = $this->upload_config['entity_file_kinds'];
        $filename = strtolower($_GET["qqfile"]);
        if ($filename == "")
            $filename = strtolower($_FILES['qqfile']['name']);
        $file_extension = self::getExtension($filename);
        $extensions = array();
        foreach ($file_types as $file_type) {
            if (class_exists($file_type)) {
                $mock = new $file_type();
                $extensions = array_merge($extensions, $mock->getAllowedExtensions());
                if (in_array($file_extension, $mock->getAllowedExtensions())) {
                    $this->mediaObject = $mock;
                    if ($this->upload_config["relation_type"] == "column") {
                        $this->mediaObject->{"set" . $this->upload_config[$file_type . '_filename_column']}($filename);
                    } else {
                        $this->mediaObject->{"set" . $this->upload_config['entity_filename_column']}($filename);
                    }
                    break;
                }
            }
        }

        if (!$this->mediaObject) {
            $this->errors[] = "<p>Le fichier \"" . $filename . "\" n'est pas pris en charge.</p>
              <p>Vous pouvez envoyer ce type de fichiers " . implode(", ", $extensions) . "</p>";
        }
    }

    /* Will save the media object and to stuff on it : 
     *      - rename if a file already exists
     *      - convert a video for example
     *      - create thumbnails
     */
    public function execute($parent_id) {
        if ($this->mediaObject) {
            $this->mediaObject->{GalleryneUtils::camelize("set".$this->upload_config["entity_aggregate_columnid"])}($parent_id);
            $this->uploader = new qqFileUploader($this->mediaObject->getAllowedExtensions(), $this->mediaObject->getLimitMax());
            $size = $this->uploader->getSize();
            $this->mediaObject->setSize($size);
            if ($this->mediaObject->isValid()) {
                $response = $this->upload();
                if (is_array($response)) {
                    $this->errors = array_merge($this->errors, implode(", ", $response));
                }else{
                    /* update the object with the new filename (appended to avoir duplicated files) */
                    $this->mediaObject->{GalleryneUtils::camelize("set".$this->upload_config["entity_filename_column"])}($response);
                }
                $this->mediaObject->callback();
            } else {
                $this->errors = array_merge($this->errors, $this->mediaObject->getErrors());
            }
        }
        return $this->errors;
    }
    
    public function callback() {
        
    }

    public function upload() {
        $upload_dir = sfconfig::get('sf_web_dir') .$this->mediaObject->getTempPath(false);
        if (!is_dir($upload_dir))
            mkdir($upload_dir, 0777, true);
        return $this->uploader->handleUpload($upload_dir, false, "tmp_".time()."_");
    }

    public static function getExtension($filename) {
        $extension = explode(".", $filename);
        $extension = strtolower($extension[count($extension) - 1]);
        return $extension = $extension == "jpg" ? "jpeg" : $extension;
    }

}

?>
