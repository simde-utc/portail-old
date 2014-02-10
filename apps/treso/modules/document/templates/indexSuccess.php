<?php use_helper('Date', 'Text');

use_javascript('treso/document/document-ctrl.js');

$docs = array();
foreach ($documents as $document) {
  if (!is_null($document->getTransactionId())) {
      $transaction = array(
        'id' => $document->getTransactionId(),
        'libelle' => $document->Transaction->getLibelle(),
        'url' => url_for('transaction_show', $document->Transaction),
        );
  } else {
      $transaction = NULL;
  }

  $docs[] = array(
      'id' => $document->getPrimaryKey(),
      'nom' => $document->getNom(),
      'date_ajout' => $document->getDateTimeObject('created_at')->getTimestamp(), // simplifie les comparaisons
      'date_ajout_affichable' => format_date($document->getCreatedAt(), 'D', 'fr'),
      'type' => $document->DocumentType->getNom(),
      'url' => url_for('document_show', $document),
      'transaction' => $transaction,
      );
} ?>
<script type="text/javascript">
function documentCtrl($scope) {
    $scope.documents = <?php echo json_encode($docs); ?>;
}
</script>

<div ng-app="DocumentApp" ng-controller="documentCtrl">
<h1>Documents stockés</h1>
<br/>
<a href="<?php echo url_for('document_new', $asso) ?>" class="btn btn-success">Ajouter un document</a>

<style type="text/css">
.table input {
  margin-bottom: 0;
}
.table thead th {
  vertical-align: top;
}
</style>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Date</span></th>
      <th>Nom <div class="pull-right"><input ng-model="search.nom" type="text" placeholder="Recherche"/></div></th>
      <th>Type</th>
      <th>Transaction</th>
    </tr>
  </thead>
  <tbody>
    <tr ng-repeat="document in documents | filter:search">
      <td class="reduce">{{ document.date_ajout_affichable }}</td>
      <td class="expand"><a href="{{ document.url }}" target="_blank">{{ document.nom }}</a></td>
      <td class="reduce">{{ document.type }}</td>
      <td class="reduce"><a ng-if="document.transaction != null" href="{{ document.transaction.url }}">{{ document.transaction.libelle }}</a></td>
    </tr>
  </tbody>
</table>

</div>