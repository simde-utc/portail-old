<option value="-1">All</option>
<?php foreach($salles as $s): ?>
<option value="<?php echo $s->getId() ?>" <?php if ($s->getId()==$id) echo "selected" ?> ><?php echo $s ?></option>
<?php endforeach; ?>
