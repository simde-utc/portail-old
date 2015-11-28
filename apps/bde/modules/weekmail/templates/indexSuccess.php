<?php
use_javascript('bde_weekmail');
use_helper('Date');
?>
<a href="<?php echo url_for('weekmail/new') ?>" class="btn btn-success" style="float: right;"><i class="icon-plus icon-white"></i>&nbsp;&nbsp;Nouveau weekmail</a>
<h1>Prochain weekmail</h1>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th style="width: 17%;">Mot du BDE</th>
            <th style="width: 17%;">Le saviez-vous?</th>
            <th style="width: 17%;">Edito</th>
            <th style="width: 17%;">Editar</th>
            <th style="width: 17%;">Articles</th>
            <th style="width: 17%;">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($current_weekmails as $weekmail): ?>
            <tr>
                <td><?php echo nl2br($weekmail->getMotDuBde()) ?></td>
                <td><?php echo nl2br($weekmail->getLeSaviezVous()) ?></td>
                <td><?php echo nl2br($weekmail->getEdito()) ?></td>
                <td><?php echo nl2br($weekmail->getEditar()) ?></td>
                <td>
                    <ul style="list-style: none; margin: 0 auto;">
                        <?php foreach ($weekmail->getWeekmailArticle() as $article): ?>
                            <li style="border-bottom: 1px dashed #999; margin: 10px auto;">
                                <div class="btn-group" style="display: inline-block; vertical-align: bottom;">
                                    <a href="" class="btn btn-primary btn-mini"><i class="icon-pencil icon-white"></i></a>
                                    <a href="<?php echo url_for('weekmail_delete_article', $article) ?>" class="btn btn-danger btn-mini"><i class="icon-trash icon-white"></i></a>
                                </div>
                                <?php echo $article->getAsso()->getName() ?>
                                <?php echo $article->getName() ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </td>
                <td>
                    <div class="btn-group">
                        <a href="<?php echo url_for('weekmail_publish', $weekmail) ?>" class="btn btn-success"><i class="icon-ok icon-white"></i>&nbsp;&nbsp;Publier</a>
                        <a href="<?php echo url_for('weekmail_edit', $weekmail) ?>" class="btn btn-primary"><i class="icon-pencil icon-white"></i></a>
                        <?php echo link_to('<i class="icon-trash icon-white"></i>', 'weekmail/delete?id=' . $weekmail->getId(), array('method' => 'delete', 'confirm' => 'Êtes-vous sur de vouloir supprimer définitivement ce  ?', 'class' => 'btn btn-danger')) ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<h1>Events à valider <small>Les événements seront ajoutés au premier Weekmail de la liste précédente</small></h1>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Asso</th>
            <th>Nom</th>
            <th>Débute le</th>
            <th>Résumé</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($events as $event): ?>
            <tr>
                <td>
                    <?php echo $event->getAsso()->getName() ?>
                </td>
                <td>
                    <a href="javascript:;" class="article_name"><?php echo $event->getName() ?></a>
                </td>
                <td><?php echo format_date($event->getStartDate(), 'd MMMM y à HH:mm', 'fr'); ?></td>
                <td style="width: 60%;"><?php echo nl2br($event->getSummary()) ?></td>
                <td style="min-width: 72px;">
                    <div class="btn-group">
                        <a href="<?php echo url_for('weekmail_accept_event', $event) ?>" class="btn btn-success"><i class="icon-ok icon-white"></i></a>
                        <a href="<?php echo url_for('weekmail_refuse_event', $event) ?>" class="btn btn-danger"><i class="icon-remove icon-white"></i></a>
                    </div>
                </td>
            </tr>
            <tr class="article_text">
                <td colspan="5"><?php echo nl2br($event->getDescription()) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<h1>Articles à valider <small>Les articles seront ajoutés au premier Weekmail de la liste précédente</small></h1>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Asso</th>
            <th>Titre</th>
            <th>Crée le</th>
            <th>Résumé</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td>
                    <?php echo $article->getAsso()->getName() ?>
                </td>
                <td>
                    <a href="javascript:;" class="article_name"><?php echo $article->getName() ?></a>
                </td>
                <td><?php echo format_date($article->getCreatedAt(), 'd MMMM y à HH:mm', 'fr')?></td>
                <td style="width: 60%;"><?php echo nl2br($article->getSummary()) ?></td>
                <td style="min-width: 72px;">
                    <div class="btn-group">
                        <a href="<?php echo url_for('weekmail_accept', $article) ?>" class="btn btn-success"><i class="icon-ok icon-white"></i></a>
                        <a href="<?php echo url_for('weekmail_refuse', $article) ?>" class="btn btn-danger"><i class="icon-remove icon-white"></i></a>
                    </div>
                </td>
            </tr>
            <tr class="article_text">
                <td colspan="5"><?php echo nl2br($article->getText()) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<h1>Les derniers weekmails</h1>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Publié le</th>
            <th>Mot du BDE</th>
            <th>Le saviez-vous ? </th>
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
                    (<?php echo count($weekmail->getWeekmailArticle()) ?> articles)
                    <?php if (strtotime($weekmail->getPublishedAt()) > time()): ?><em>(Non publié)</em><?php endif ?>
                </td>
                <td><?php echo $weekmail->getMotDuBde() ?></td>
                <td><?php echo $weekmail->getLeSaviezVous() ?></td>
                <td><?php echo $weekmail->getEdito() ?></td>
                <td><?php echo $weekmail->getEditar() ?></td>
                <td style="min-width: 108px;">
                    <div class="btn-group">
                        <a href="<?php echo url_for('weekmail_html', $weekmail) ?>" class="btn">
                            <i class="icon-envelope"></i>
                        </a>
                        <a href="<?php echo url_for('weekmail_edit', $weekmail) ?>" class="btn btn-primary">
                            <i class="icon-pencil icon-white"></i>
                        </a>
                        <?php echo link_to('<i class="icon-trash icon-white"></i>', 'weekmail/delete?id=' . $weekmail->getId(), array('method' => 'delete', 'confirm' => 'Êtes-vous sur de vouloir supprimer définitivement ce  ?', 'class' => 'btn btn-danger')) ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
