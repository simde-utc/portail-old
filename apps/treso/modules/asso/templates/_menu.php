<?php function active_if($module, $current_module) {
    if ($module == $current_module)
        echo 'class="active"';
} ?>
<div class="nav-collapse collapse">
    <ul class="nav">
        <?php if(!empty($asso)): ?>
        <li <?php active_if('budget', $cm) ?>><a href="<?php echo url_for('budget_list',$asso) ?>">Budget Prévisionnel</a></li>
        <li <?php active_if('transaction', $cm) ?>><a href="<?php echo url_for('transaction',$asso) ?>">Livre de compte</a></li>
        <li <?php active_if('cheque', $cm) ?>><a href="<?php echo url_for('cheque_list',$asso) ?>">Liste des chèques</a></li>
        <li <?php active_if('compte', $cm) ?>><a href="<?php echo url_for('compte',$asso) ?>">Comptes bancaires</a></li>
        <li <?php active_if('noteDeFrais', $cm) ?>><a href="<?php echo url_for('ndf',$asso) ?>">Notes de frais</a></li>
        <?php if($asso->isPole()): ?>
            <li <?php active_if('avances', $cm) ?>><a href="<?php echo url_for('avances',$asso) ?>">Avances de trésorerie</a></li>
        <?php endif ?>
        <?php endif ?>
    </ul>
</div>
