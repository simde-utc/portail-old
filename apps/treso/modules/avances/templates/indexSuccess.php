<?php use_helper('Date', 'Number'); ?>

<h1>Avances de trésorerie</h1>
<br/>
  <a href="<?php echo url_for('avances_new', $asso) ?>" class="btn btn-success">Nouvelle avance</a>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th colspan="4" style="text-align: center;">Avances précédentes</th>
    </tr>
    <tr>
      <th>Asso</th>
      <th>Commentaire</th>
      <th>Montant</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($avances_treso as $avance_treso): ?>
    <tr>
      <td><?php echo $avance_treso->Asso->getName(); ?></td>
      <td><?php echo nl2br($avance_treso->getCommentaire()) ?></td>
      <td><?php echo format_currency($avance_treso->getTransaction()->getMontant(), '€', 'fr') ?></td>
      <td><?php echo format_date($avance_treso->getTransaction()->getDateTransaction(), 'D', 'fr') ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
