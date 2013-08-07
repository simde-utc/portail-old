<?php $galleries = Gallery::getAllGalleries() ?>

<div>
    <?php slot('h1') ?>
    Liste des Portfolios
    <?php end_slot() ?>

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
					$default = $gallery->getPhotoDefault()->getPicpath() == "" ? sfConfig::get("app_gallerynePlugin_defaultPicture") :
                            $correctPath.$gallery->getSlug()."/".
				sfConfig::get("app_gallerynePlugin_portfolio_thumbnails_size")."/".$gallery->getPhotoDefault()->getPicpath();
                    ?>
                	<img src="<?php echo $default ?>"/>
            	</a>
	</div>
    </div>
    <?php endforeach; ?>
</div>
<?php echo count($galleries) >= 4 ? '<div class="clear"></div>' : ""; ?>
