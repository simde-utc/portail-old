<?php use_helper('I18N') ?>
<?php if($galleries->getFirst() instanceof Gallery){
    include_component("slideshow","widget", array(
    "gallery"=> $galleries->getFirst(),
    "template" => "anything"
));} ?>


<?php echo !count($galleries) ? __("slideshow.index.empty") : __("slideshow.index.title");?>
<div>
    <?php foreach ($galleries as $i=>$gallery): ?>
    <div class="cont">
        <div>
		<a class="title" href="<?php echo url_for(@showGallery, $gallery) ?>">
                	<h3><?php echo $gallery->getTitle() ?></h3>
		</a>
	</div>
        <div>
		<a href="<?php echo url_for(@showGallery, $gallery) ?>">
                    <?php 
                    $correctPath = GalleryneUtils::gallery_path();
                    $default = $gallery->getPhotoDefault() == "" ? sfConfig::get("app_gallerynePlugin_defaultPicture") :
                            $gallery->getPhotoDefault();
                    ?>
                	<img src="<?php echo $default ?>"/>
            	</a>
	</div>
    </div>
    <?php echo count($galleries) >= 4 ? '<div class="clear"></div>' : ""; ?>
    <?php endforeach; ?>
</div>



