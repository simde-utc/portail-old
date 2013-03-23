<?php use_helper('Thumb'); ?>

<?php if($assos && $assos->count() > 0): ?>
    <?php foreach($assos as $asso): ?>
        <div style="display: inline-block; margin: 10px;">
            <a href="<?php echo url_for("budget_list", $asso) ?>">
                <div style="text-align: center;"><?php echo $asso->getName() ?></div>
                <div class="logo_asso">
                    <?php echo showThumb($asso->getLogo(), 'assos', array('width' => 150, 'height' => 150), 'scale') ?>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
<?php endif ?>