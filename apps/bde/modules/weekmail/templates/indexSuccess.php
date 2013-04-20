<h1>Articles à valider</h1>
<table class="table table-striped table-bordered table-hover">
    <?php foreach ($articles as $article): ?>
        <tr>
            <td><?php echo $article->getAsso()->getName() ?></td>
            <td><?php echo $article->getName() ?></td>
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
        <tr>
            <td colspan="3"><strong>Texte: </strong><?php echo $article->getText() ?></td>
        </tr>
    <?php endforeach; ?>
</table>