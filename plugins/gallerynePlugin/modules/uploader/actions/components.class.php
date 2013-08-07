<?php

/**
 * Description of uploaderComponents
 *
 * @author lbernard
 */

class uploaderComponents extends sfComponents {

    public function executeList()
    {
        $fullConfig = sfConfig::get("app_gallerynePlugin_uploader");
        $this->upload_config = $fullConfig[$this->config_name];
        $this->files = $files = array();
        $this->asked_actions = $this->actions;
        $this->actions = GalleryneUtils::getActions();
        /* Filter available actions with asked actions */
        foreach ($this->actions as $key=>$action){
            if(!in_array($action->getName(), $this->asked_actions)){
                unset($this->actions[$key]);
            }
        }
        /* END of filter */
        if($this->upload_config['relation_type'] == 'related_table'){
            if(!is_array($this->type)) $this->file_types = $this->upload_config['entity_file_kinds'];
        }
        /* Browse each type of allowed files types */
        foreach ($this->file_types as $type) {
            $mock = new $type();
            /* get the temporary files path */
            $tmpPath = $mock->getTempPath();
            if (isset($this->{$this->upload_config["aggregate_entity_class_name"] . "_" . $type})) {
            $uploaded_files = $this->{$this->upload_config["aggregate_entity_class_name"] . "_" . $type};
                foreach (explode(",", $uploaded_files) as $uploaded_file) {
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
                        $file["type"] = $type;
                        } else {
                            $file["path"] = $tmpPath . $uploaded_file;
                        $file["type"] = $type;
                        }
                    } else {
                        $file["path"] = $tmpPath . $uploaded_file;
                        $file["type"] = $type;
                        $obj = new $this->upload_config["aggregate_entity_class_name"]();
                        $file = array_merge($file, $obj->toArray());
                        foreach ($file as &$item) {
                            if ($item === null)
                                $item = 0;
                        }
                        $file[$this->upload_config["entity_filename_column"]] = $uploaded_file;
                    }
                    $file["input_name"] = $this->upload_config["aggregate_entity_class_name"] . "_" . $type;
                    $this->files[$uploaded_file] = $file;
                }
            }else{/* it could be better but for now... */
                /* END of filter */
                if($this->upload_config['relation_type'] == 'related_table'){
                    if(!is_array($this->type)) $this->types = $this->upload_config['entity_file_kinds'];
                    foreach($this->types as $type){
                        $files = Doctrine::getTable(ucfirst($type))->createQuery('f')
                                ->where('f.'.$this->upload_config['entity_aggregate_columnid'].' = ?',$this->parent_id)
                                ->execute();
                    }

                }elseif($this->upload_config['relation_type'] == 'enum'){
                    $files = Doctrine::getTable($this->upload_config["aggregate_entity_class_name"])
                            ->createQuery("p")
                            ->where('p.'.$this->upload_config['entity_aggregate_columnid'].'=?',$this->parent_id)
                            ->andWhereIn("p.".$this->upload_config['entity_type_column_name'],  $this->file_types)
                            ->execute();
                }
            }
        }
        
        foreach($files as $file){
            if(!is_array($file)){
                $file = array($file);
            }
            foreach($file as $f){
                $fileArray = $f->toArray();
                $fileArray["input_name"] = $this->upload_config["aggregate_entity_class_name"]."_".$type;
                $fileArray["path"] = $f->getFullPath(true); 
                $fileArray["type"] = get_class($f);
                array_push($this->files,$fileArray);
            }
        }
    }

}
?>