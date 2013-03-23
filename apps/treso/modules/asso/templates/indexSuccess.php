<?php use_helper('Thumb'); ?>

<?php if($assos && $assos->count() > 0): ?>
  <div>
      <?php foreach($assos as $asso): ?>
    <div>
        <a href="<?php echo url_for("budget_list", $asso) ?>"><?php echo $asso->getName() ?></a>
    </div>
      <?php endforeach; ?>
  </div>
<?php endif ?>