<?php use_javascript('bde_weekmail') ?>
<h1>Articles à valider</h1>
<table class="table table-striped table-bordered table-hover">
    <?php foreach ($articles as $article): ?>
        <tr>
            <td>
                <?php echo $article->getAsso()->getName() ?>
            </td>
            <td>
                <a href="javascript:;" class="article_name"><?php echo $article->getName() ?></a>
            </td>
            <td>
                <div class="btn-group">
                    <a href="" class="btn btn-success"><i class="icon-ok icon-white"></i>&nbsp;&nbsp;Accepter</a>
                    <a href="" class="btn btn-danger"><i class="icon-remove icon-white"></i>&nbsp;&nbsp;Refuser</a>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3"><strong>Résumé: </strong><?php echo $article->getSummary() ?></td>
        </tr>
        <tr class="article_text">
            <td colspan="3"><strong>Texte: </strong><?php echo $article->getText() ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="<?php echo url_for('weekmail/new') ?>" class="btn btn-success" style="float: right;"><i class="icon-plus icon-white"></i>&nbsp;&nbsp;Nouveau weekmail</a>
<h1>Les derniers weekmail</h1>
<table class="table table-striped table-bordered table-hover">
    <tr>
        <td>Publié le</td>
        <td>Edito</td>
        <td>Editar</td>
        <td>Actions</td>
    </tr>
<?php foreach($weekmails as $weekmail): ?>
    <tr>
        <td><?php echo $weekmail->getPublishedAt() ?></td>
        <td><?php echo $weekmail->getEdito() ?></td>
        <td><?php echo $weekmail->getEditar() ?></td>
        <td><a href="<?php echo url_for('weekmail_edit', $weekmail) ?>" class="btn btn-primary"><i class="icon-pencil icon-white"></i>&nbsp;&nbsp;Editer</a></td>
    </tr>
<?php endforeach; ?>
</table>