<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form style="margin: 20px auto;" id="transaction-form" action="<?php echo url_for('transaction/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>

    <?php foreach ($form as $label => $widget) : ?>
        <?php if (!$widget->isHidden() && !in_array($label, array('montant', 'debit'))): ?>
            <?php echo $widget->renderLabel() ?>
            <?php echo $widget->render() ?>
            <br/>
        <?php endif ?>

        <?php if ($label == 'montant') : ?>
            <?php echo $widget->renderLabel() ?>
            <?php echo $widget->render() ?>

            <div style="display : inline-block;">
                <?php echo $form['debit']->renderLabel(null, array('style' => 'display : inline-block; min-width: auto; margin-right : 15px; margin-left: 10px;')) ?>
                <?php echo $form['debit']->render() ?>
            </div>
            <br/>
        <?php endif ?>

    <?php endforeach; ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <div style="margin-left: 135px;">
        <a href="<?php echo url_for('transaction', (!$form->getObject()->isNew()) ? $form->getObject()->getAsso() : $asso) ?>" class="btn">Retour liste</a>
        <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Supprimer', 'transaction/delete?id=' . $form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Voulez-vous vraiment supprimer cette transaction ?', 'class' => 'btn btn-danger')) ?>
        <?php endif; ?>
        <input type="submit" value="Valider" class="btn btn-primary"/>
    </div>
</form>