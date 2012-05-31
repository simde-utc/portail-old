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
        $this->upload_config = $fullConfig[$this->upload_config];
        $this->files = array();
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
        foreach($files as $file){
            if(!is_array($file)){
                $file = array($file);
            }
            foreach($file as $f){
                $fileArray = $f->toArray();
                $fileArray["input_name"] = $this->upload_config["aggregate_entity_class_name"]."_".$type;
                $fileArray["path"] = $f->getFullPath(true); 
                array_push($this->files,$fileArray);
            }
        }
    }

}
?>
