<?php use_javascript('bde_weekmail') ?>
<a href="<?php echo url_for('weekmail/new') ?>" class="btn btn-success" style="float: right;"><i class="icon-plus icon-white"></i>&nbsp;&nbsp;Nouveau weekmail</a>
<h1>Prochain weekmail</h1>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Edito</th>
            <th>Editar</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($current_weekmails as $weekmail): ?>
            <tr>
                <td><?php echo $weekmail->getEdito() ?></td>
                <td><?php echo $weekmail->getEditar() ?></td>
                <td>
                    <div class="btn-group">
                        <a href="<?php echo url_for('weekmail_edit', $weekmail) ?>" class="btn btn-primary"><i class="icon-pencil icon-white"></i>&nbsp;&nbsp;Editer</a>
                        <a href="<?php echo url_for('weekmail_publish', $weekmail) ?>" class="btn btn-success"><i class="icon-ok icon-white"></i>&nbsp;&nbsp;Publier</a>
                        <?php echo link_to('<i class="icon-trash icon-white"></i>&nbsp;&nbsp;Supprimer', 'weekmail/delete?id='.$weekmail->getId(), array('method' => 'delete', 'confirm' => 'Êtes-vous sur de vouloir supprimer définitivement ce  ?', 'class' => 'btn btn-danger')) ?>
                    </div>
                </td>
            </tr>
            <?php foreach($weekmail->getWeekmailArticle() as $article): ?>
            <tr>
                <td>
                    <?php echo $article->getAsso()->getName() ?>
                </td>
                <td>
                    <a href="javascript:;" class="article_name"><?php echo $article->getName() ?></a>
                </td>
                <td>
                    <div class="btn-group">
                        <a href="" class="btn btn-primary"><i class="icon-pencil icon-white"></i>&nbsp;&nbsp;Editer</a>
                        <a href="<?php echo url_for('weekmail_delete_article', $article) ?>" class="btn btn-danger"><i class="icon-trash icon-white"></i>&nbsp;&nbsp;Supprimer</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3"><strong>Résumé: </strong><?php echo $article->getSummary() ?></td>
            </tr>
            <tr class="article_text">
                <td colspan="3"><strong>Texte: </strong><?php echo $article->getText() ?></td>
            </tr>
            <?php endforeach ?>
        <?php endforeach; ?>
    </tbody>
</table>
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
                    <a href="<?php echo url_for('weekmail_accept', $article) ?>" class="btn btn-success"><i class="icon-ok icon-white"></i>&nbsp;&nbsp;Accepter</a>
                    <a href="<?php echo url_for('weekmail_refuse', $article) ?>" class="btn btn-danger"><i class="icon-remove icon-white"></i>&nbsp;&nbsp;Refuser</a>
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
<h1>Les derniers weekmails</h1>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Publié le</th>
            <th>Edito</th>
            <th>Editar</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($weekmails as $weekmail): ?>
            <tr>
                <td>
                    <?php echo $weekmail->getPublishedAt() ?>
                    <?php if (strtotime($weekmail->getPublishedAt()) > time()): ?><em>(Non publié)</em><?php endif ?>
                </td>
                <td><?php echo $weekmail->getEdito() ?></td>
                <td><?php echo $weekmail->getEditar() ?></td>
                <td><a href="<?php echo url_for('weekmail_edit', $weekmail) ?>" class="btn btn-primary"><i class="icon-pencil icon-white"></i>&nbsp;&nbsp;Editer</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>