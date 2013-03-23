<?php if($assos && $assos->count() > 0): ?>
  <div class="nav-collapse">
    <ul class="nav">
      <?php foreach($assos as $asso): ?>
        <li class="<?php if(!empty($current_asso) && ($current_asso->getId() == $asso->getId())): ?>active<?php endif ?>">
            <a href="<?php echo url_for('budget_list', $asso) ?>"><?php echo $asso->getName() ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif ?>