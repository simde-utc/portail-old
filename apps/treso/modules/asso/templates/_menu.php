<div class="well sidebar-nav">
    <ul class="nav nav-list">
        <?php if(!empty($asso)): ?>
        <li class="nav-header"><?php echo $asso->getName() ?></li>
        <li><a href="<?php echo url_for('budget_list',$asso) ?>">Budget Prévisionnel</a></li>
        <li><a href="<?php echo url_for('transaction',$asso) ?>">Livre de compte</a></li>
        <li><a href="<?php echo url_for('compte',$asso) ?>">Comptes bancaires</a></li>
        <li><a href="<?php echo url_for('ndf',$asso) ?>">Notes de frais</a></li>
        <?php endif ?>
    </ul>
</div><!--/.well -->