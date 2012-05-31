<?php use_helper('ajax'); ?>
<input type="hidden" name="<?php echo $name;?>" value="<?php echo $value;?>"/>
<div id="<?php echo $id ?>_files_list" style="margin-top: 15px">
<?php 
    if($parent_id!="null"){
        $callbackArray = explode('/',$callback);
        echo get_component($callbackArray[0],$callbackArray[1], array('parent_id' => $parent_id,'file_types'=>$file_types,"with_default"=>$with_default,"with_meta"=>$with_meta, 'config_name' => $upload_config,"actions"=>$actions));
    } ?>
</div>
<div id="<?php echo $id ?>" class="uploader-btn"><?php echo 'Ajouter des fichiers' ?></div>
<!--List Files-->
<ul id="<?php echo $id ?>files" ></ul>
<div class="clear"></div>
<?php $fullConfig = sfConfig::get("app_gallerynePlugin_uploader"); ?>
<?php $config = $fullConfig[$upload_config]; ?>
<script>
    function createUploader(id){
    var <?php echo $id."uploader" ?> = new qq.FileUploader({
            element: document.getElementById("<?php echo $id ?>"),
            template: "<?php echo addslashes(get_partial("uploader/uploaderButtonTemplate",array("button_label"=>$button_label))) ?>",
            action: "<?php echo $upload_method ?>",
            params:
                {
                        upload_config: "<?php echo $upload_config; ?>",
                        parent_id: <?php echo $parent_id; ?>,
                        file_types: "<?php echo $file_types; ?>"
                },
            onComplete: function(id, file, responseJson){
                    if(responseJson.success == true){
                        $("#<?php echo $id ?>_files_list").after("<input  type='checkbox' name='<?php echo $config["aggregate_entity_class_name"]; ?>_"+responseJson.filetype+"[]' style='display: none' class='tmp <?php echo $config["aggregate_entity_class_name"]; ?>_"+responseJson.filetype+"' value='"+responseJson.filename+"'/>");
                    }
                    <?php $file_typesArray = explode(",",$file_types);
                    foreach($file_typesArray as $type){ ?>
<?php echo "var ".$config["aggregate_entity_class_name"]."_".$type." = ''".PHP_EOL; ?>
                    $("input.<?php echo $config["aggregate_entity_class_name"]."_".$type; ?>").each(function(){
                        if(<?php echo $config["aggregate_entity_class_name"]."_".$type ?>!= "") <?php echo $config["aggregate_entity_class_name"]."_".$type ?> +=",";
                        <?php echo $config["aggregate_entity_class_name"]."_".$type." += $(this).val();".PHP_EOL; ?>
                    });
                    <?php }echo "\n"; ?>
                    $.post("<?php echo url_for($callback) ?>",
                    {
                        config_name: "<?php echo $upload_config; ?>",
                        parent_id: <?php echo $parent_id; ?>,
                        with_meta: <?php echo $with_meta; ?>,
                        file_types: "<?php echo $file_types; ?>",
                        actions: "<?php echo implode(",", $sf_data->getRaw("actions")); ?>",
<?php foreach($file_typesArray as $i=>$type){ ?>
                        <?php echo $config["aggregate_entity_class_name"]."_".$type." : ".$config["aggregate_entity_class_name"]."_".$type.($i!=count($file_typesArray)-1?",":"")."\n"; ?>
<?php } ?>
                    },

                    function(data)
                    {
                        $("#<?php echo $id ?>_files_list").html(data);
                        $("#<?php echo $id ?> #status").removeClass("loading");
                        $("#<?php echo $id ?> #status").addClass("success");
                    });
                    
                },
            onSubmit: function(id, fileName){
                },
            onProgress: function(id, fileName){
                    $("#<?php echo $id ?> #status").addClass("success");
                    $("#<?php echo $id ?> #status").addClass("loading");
                }
            });
            
    }
    window.onload = createUploader("<?php echo $id ?>");
</script>