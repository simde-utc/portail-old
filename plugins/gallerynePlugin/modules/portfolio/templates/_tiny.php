
<div class="sliderGallery">
    <ul>
        <?php foreach ($gallery->getPhotos() as $photo) {?>
        <li>
            <?php echo utils::light_image("/uploads/thumbnail/150_".$photo->getPicPath(), "/uploads/".$photo->getPicPath(), array('title' => $photo->getTitle() )); ?>
        </li>
        <?php } ?>
    </ul>
    <div class="slider">
        <div class="handle"></div>
    </div>
</div>