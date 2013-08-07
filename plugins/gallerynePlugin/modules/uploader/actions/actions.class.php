<?php

require_once dirname(__FILE__) . '/../lib/BaseuploaderActions.class.php';

/**
 * uploader actions.
 * 
 * @package    gallerynePlugin
 * @subpackage uploader
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */
class uploaderActions extends BaseuploaderActions {

    public function executeUpload(sfWebRequest $request) {
        $parent_id = $request->getParameter("parent_id");
        $file_types = explode(",", $request->getParameter("file_types"));
        $upload_config = $request->getParameter("upload_config");
        $upload_manager = new UploadManager($upload_config);
        $upload_manager->bind($file_types);
        $errors = $upload_manager->execute($parent_id);
        $success = !count($errors) ? true : false;
        $array = array(
            "success" => $success,
            "message" => is_array($errors) ? implode(",", $errors) : ""
        );
        if ($success) {
            if ($this->upload_config["relation_type"] == "column") {
                $array["filename"] = strtolower($upload_manager->mediaObject->{"get" . $upload_manager->upload_config[strtolower(get_class($upload_manager->mediaObject)) . '_filename_column']}());
            } else {
                $array["filename"] = strtolower($upload_manager->mediaObject->{"get" . $upload_manager->upload_config['entity_filename_column']}());
            }
            $array["filetype"] = get_class($upload_manager->mediaObject);
        }
        return $this->renderText(json_encode($array));
    }

    public function executeList(sfWebRequest $request) {
        /* get parameteres */
        $this->parent_id = $request->getParameter("parent_id");
        $this->with_meta = $request->getParameter("with_meta");
        $this->file_types = $request->getParameter("file_types");
        $this->asked_actions = explode(",",$request->getParameter("actions"));
        $this->actions = GalleryneUtils::getActions();
        /* Filter available actions with asked actions */
        foreach ($this->actions as $key=>$action){
            if(!in_array($action->getName(), $this->asked_actions)){
                unset($this->actions[$key]);
            }
        }
        /* END of filter */
        $this->config_name = $request->getParameter("config_name");
        /* get the config */
        $fullConfig = sfConfig::get("app_gallerynePlugin_uploader");
        $this->upload_config = $fullConfig[$this->config_name];
        /* variable initialization */
        $this->files = array();
        if (!is_array($this->file_types))
            $this->file_types = array($this->file_types);
        /* Browse each type of allowed files types */
        foreach ($this->file_types as $type) {
            $mock = new $type();
            /* get the temporary files path */
            $tmpPath = $mock->getTempPath();
            if ($request->getParameter($this->upload_config["aggregate_entity_class_name"] . "_" . $type) != "") {
                $this->{$this->upload_config["aggregate_entity_class_name"] . "_" . $type} = $this->upload_config["aggregate_entity_class_name"] . "_" . $type;
                foreach (explode(",", $request->getParameter($this->upload_config["aggregate_entity_class_name"] . "_" . $type)) as $uploaded_file) {
                    $file = array();
                    $file[$this->upload_config["entity_filename_column"]] = $uploaded_file;
                    /* test if the file doesn't exist in temp folder */
                    if (!file_exists(sfConfig::get("sf_web_dir") . $tmpPath . $uploaded_file)) {
                        /* test the kind of relation */
                        if ($this->upload_config['relation_type'] == 'related_table') {
                            $obj = Doctrine::getTable($type)->createQuery("f")
                                    ->where("f." . $this->upload_config["entity_filename_column"] . " = ?", $file[$this->upload_config["entity_filename_column"]])
                                    ->andWhere("f." . $this->upload_config["entity_aggregate_columnid"] . " = ?", $this->parent_id)
                                    ->fetchOne();
                        } elseif ($this->upload_config['relation_type'] == 'enum') {
                            $obj = Doctrine::getTable($this->upload_config["aggregate_entity_class_name"])
                                    ->createQuery("f")
                                    ->where("f." . $this->upload_config["entity_filename_column"] . " = ?", $file[$this->upload_config["entity_filename_column"]])
                                    ->andWhere("f." . $this->upload_config["entity_aggregate_columnid"] . " = ?", $this->parent_id)
                                    ->fetchOne();
                        }
                        if ($obj) {
                            $file = $obj->toArray();
                            $file["path"] = $obj->getFullPath(true);
                            $file["type"] = get_class($obj);
                        } else {
                            $file["path"] = $tmpPath . $uploaded_file;
                            $file["type"] = $type;
                        }
                    } else {
                        $file["path"] = $tmpPath . $uploaded_file;
                        $file["type"] = $type;
                        $file["title"] = $file["description"] = "";
                        $obj = new $this->upload_config["aggregate_entity_class_name"]();
                        $file = array_merge($file, $obj->toArray());
                        foreach ($file as &$item) {
                            if ($item === null)
                                $item = 0;
                        }
                        $file[$this->upload_config["entity_filename_column"]] = $uploaded_file;
                    }
                    $file["input_name"] = $this->upload_config["aggregate_entity_class_name"] . "_" . $type;
                    $file["type"] = $type;
                    $this->files[$uploaded_file] = $file;
                }
            }
        }
        return $this->renderPartial("uploader/list", $this->getVarHolder()->getAll());
    }

}
