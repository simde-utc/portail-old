<div class="well sidebar-nav">
    <ul class="nav nav-list">
        <?php if(!empty($asso)): ?>
        <li class="nav-header"><?php echo $asso->getName() ?></li>
        <li><a href="<?php echo url_for('budget_list',$asso) ?>">Budget Prévisionnel</a></li>
        <li><a href="<?php echo url_for('transaction',$asso) ?>">Livre de compte</a></li>
        <li><a href="<?php echo url_for('cheque_list',$asso) ?>">Liste des chèques</a></li>
        <li><a href="<?php echo url_for('compte',$asso) ?>">Comptes bancaires</a></li>
        <li><a href="<?php echo url_for('ndf',$asso) ?>">Notes de frais</a></li>
        <li><a href="<?php echo url_for('documents',$asso) ?>">Documents</a></li>
        <?php if($asso->isPole()): ?>
            <li><a href="<?php echo url_for('avances',$asso) ?>">Avances de trésorerie</a></li>
        <?php endif ?>
        <?php endif ?>
    </ul>
</div><!--/.well -->