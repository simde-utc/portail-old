<div class="files_list" id="files_list_<?php echo "_" . $parent_id ?>">
    <?php use_helper('GalleryneAlertify') ?>
    <?php foreach(array('galleryne.warning','galleryne.errors') as $notice)
            echo displayGalleryneNotifications($notice);
    if(!count($files)){
    ?>
    <p><?php echo __("list_empty","","galleryne"); ?></p>
    <?php }else{ ?>
    <ul>
        <?php foreach ($sf_data->getRaw("files") as $file) {
            $src = GalleryneUtils::getIcon($file["path"],  sfConfig::get("sf_web_dir")); ?>
        <li id="<?php echo GalleryneUtils::slugify($file[$upload_config['entity_filename_column']]) ?>">
                <input type="checkbox" name="<?php echo $file["input_name"] ?>[]" style="display: none" class="<?php echo $file["input_name"] ?>" value="<?php echo $file[$upload_config['entity_filename_column']]; ?>" checked="checked"/>
                    <?php if(isset($actions) && count($actions)>0 || $with_meta){ ?>
                    <div class="galleryne_actions">
                        <ul>
                            <?php if($with_meta){ ?>
                            <li>
                                <p>
                                <label>Titre :
                                    <input type="text" name="<?php echo $file["input_name"] ?>_meta[<?php echo $file[$upload_config['entity_filename_column']] ?>][title]" value="<?php echo $file['title'] ?>"/>
                                </label>
                                </p>
                                <p style="clear:both">
                                <label>Description:
                                    <textarea name="<?php echo $file["input_name"] ?>_meta[<?php echo $file[$upload_config['entity_filename_column']] ?>][description]"><?php echo $file['description'] ?></textarea>
                                </label>
                                </p>
                            </li>
                            <?php } ?>
                            <?php 
                                $file_params = $params = array();
                                foreach($sf_data->getRaw('files') as $file_tmp){
                                    $file_params[$file["type"]][] = $file_tmp[$upload_config['entity_filename_column']];
                                }
                                foreach($file_params as $type=>$filenames){
                                    $params["Gallery_".$type] = implode(",", $filenames);
                                }
                            ?>
                            <?php foreach($sf_data->getRaw("actions") as $action){ ?>
                            <li>
                                <?php include_partial($action->getView(),array(
                                    "action" => $action,
                                    "parent_id" => $parent_id,
                                    "input_name" => $file["input_name"],
                                    "filename" => $file[$upload_config['entity_filename_column']],
                                    "file" => $file,
                                    'classname' => $file['type'],
                                    'id'=>$file['id'],
                                    "url" => url_for(@photoAction, 
                                            array_merge($action->getParams(),$params,array(
                                            'id'=>$file['id'],
                                            'filename'=>$file[$upload_config['entity_filename_column']],
                                            'callback'=> implode(",",array('uploader','list')),
                                            'classname' => $file['type'],
                                            'with_meta' => $with_meta,
                                            'parent_id' => $parent_id,
                                            'file_types'=>(is_array($sf_data->getRaw('file_types'))?implode(',',$sf_data->getRaw('file_types')):$sf_data->getRaw('file_types')),
                                            'config_name' => $config_name,
                                            'actions'=> implode(',',$sf_data->getRaw('asked_actions'))
                                            )
                                        ))
                                    )); ?>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </span>
                <?php } ?>
                <div class="file-preview" id="file-preview-<?php echo GalleryneUtils::slugify($file[$upload_config['entity_filename_column']]) ?>">
                    <img src="<?php echo $src ?>" height="50" />
                </div>
                <span>
                <div class="galleryne_content">
                    <?php if(isset($file['title'])){?><span style="margin-left: 15px;font-weight: bold;font-size: 13px"><?php echo $file['title'] ?></span><br/><?php } ?>
                    <?php if(isset($file['description'])){?><span style="margin-left: 15px;"><?php echo $file['description'] ?></span><?php } ?>
                </div>
                    <div style="clear: both"></div>
                <?php if(isset($with_default) && $with_default){ ?>
                    <label>
                        <input type="radio" name="<?php echo $file["input_name"] ?>_is_default" <?php echo isset($file["is_default"]) && $file["is_default"] == true ? "checked=checked" : "" ?> value="<?php echo $file[$upload_config['entity_filename_column']]; ?>"/>
                        Couverture de la galerie
                    </label>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>
    <?php } ?>
</div>

<style>
    .files_list ul{
        list-style: none;
    }
    .files_list li{
        border: 1px solid #DDD;
        border-radius: 5px;
        overflow: hidden;
        padding: 10px 5px;
        margin: 10px;
    }
    .files_list li .file-preview img{
        float: left;
        padding: 4px;
        border: 1px solid #ddd;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        -webkit-box-shadow: 0 5px 5px rgba(0, 0, 0, 0.075);
        -moz-box-shadow: 0 5px 5px rgba(0, 0, 0, 0.075);
        box-shadow: 0 5px 5px rgba(0, 0, 0, 0.075);
    }
    .files_list li .file-preview img:hover{
        border-color: #0069d6;
        -webkit-box-shadow: 0 1px 4px rgba(0, 105, 214, 0.25);
        -moz-box-shadow: 0 1px 4px rgba(0, 105, 214, 0.25);
        box-shadow: 0 1px 4px rgba(0, 105, 214, 0.25);
    }
    .files_list li .file-preview{
        text-align: center;
        width: 150px;
    }
    .files_list li .galleryne_actions{
        float: right;
        width: 450px;
    }
    .files_list li .galleryne_content{
        margin-left: 15px;
    }

</style>