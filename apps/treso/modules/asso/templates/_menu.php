<div class="well sidebar-nav">
    <ul class="nav nav-list">
        <?php foreach($assos as $asso): ?>
            <li class="nav-header"><?php echo $asso->getName() ?></li>
            <li><a href="<?php echo url_for('budget_list',$asso) ?>">Budget</a></li>
            <li><a href="<?php echo url_for('transaction',$asso) ?>">Livre de compte</a></li>
            <li><a href="<?php echo url_for('compte',$asso) ?>">Compte bancaire</a></li>
            <li><a href="#">Notes de frais</a></li>
        <?php endforeach ?>
    </ul>
</div><!--/.well -->