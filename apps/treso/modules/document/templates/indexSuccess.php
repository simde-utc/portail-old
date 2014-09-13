<?php use_helper('Date', 'Text');

use_javascript('treso/common/portail.js');
use_javascript('treso/document/document-ctrl.js');

// à terme cette partie dégage
// il y aura un service angular pour récupérer les documents par XMLHttpRequest
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
      'type' => $document->DocumentType->getNom(),
      'url' => url_for('document_show', $document),
      'transaction' => $transaction,
      );
} ?>
<script type="text/javascript">
// pareil
// à terme on aura plus à écrire les docs direct dans le JS
// donc on pourra mettre le controller à sa juste place (document-ctrl.js)
function documentCtrl($scope, $filter) {
    $scope.documents = <?php echo json_encode($docs); ?>;
    $scope.date = {start: 0, end: undefined, selectedRange: undefined};
    $scope.allowed_types = {t: null};
    $scope.rangeSelected = function() {
      if ($scope.date.selectedRange == undefined)
        return false;
      return $scope.date.selectedRange.year != undefined;
    };
    $scope.updateDocumentList = function() {
      //alert($scope.date.start);
      var filtered = $filter('filter')($filter('int_range')($scope.documents, 'date_ajout',
                                                                        $scope.date.start, $scope.date.end),
                                                   $scope.search);
      $scope.types = $filter('unique')(filtered, 'type');

      $scope.filteredDocuments = $filter('filter')(filtered, function(doc, index) {
        if ($scope.allowed_types.t == null) {
          return true;
        }
        return $scope.allowed_types.t.indexOf(doc.type) >= 0; // le "in_array" de javascript
      });
      //$scope.filteredDocuments = $filter('in_array')(filtered, 'type', $scope.allowed_types.t);
      // | filter:search | int_range:'date_ajout':date.start:date.end | in_array:'type':allowed_types
    }
    $scope.$watch('date.start', $scope.updateDocumentList);
    $scope.$watch('date.end', $scope.updateDocumentList);
    $scope.$watch('search.nom', $scope.updateDocumentList);
    $scope.$watch('documents', $scope.updateDocumentList);
    $scope.$watch('allowed_types.t', $scope.updateDocumentList);
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
      <th><portail-dropdown>
            <button class="btn dropdown-toggle" portail-dropdown-trigger>
              <span ng-if="!rangeSelected()">Date</span>
              <span ng-if="rangeSelected()">{{ date.selectedRange.month }} {{ date.selectedRange.year }}</span>
              <i class="caret"></i></button>
            <portail-dropdown-content style="width: 300px">
              <portail-date-range header="Filtrer par date" selection="date.selectedRange" start="date.start" end="date.end"></portail-date-range>
            </portail-dropdown-content>
          </portail-dropdown>
      </th>
      <th>Nom <div class="pull-right"><input ng-model="search.nom" type="text" placeholder="Recherche"/></div></th>
      <th><portail-dropdown>
            <button class="btn dropdown-toggle" portail-dropdown-trigger>Type <i class="caret"></i></button>
            <portail-dropdown-content>
              <portail-options-chooser options="types" selected="allowed_types" />
            </portail-dropdown-content>
      </th>
      <th>Transaction</th>
    </tr>
  </thead>
  <tbody>
    <tr ng-repeat="document in filteredDocuments">
      <td class="reduce">{{ document.date_ajout * 1000 | date:'d MMMM yyyy' }}</td>
      <td class="expand"><a href="{{ document.url }}" target="_blank">{{ document.nom }}</a></td>
      <td class="reduce">{{ document.type }}</td>
      <td class="reduce"><a ng-if="document.transaction != null" href="{{ document.transaction.url }}">{{ document.transaction.libelle }}</a></td>
    </tr>
  </tbody>
</table>

</div>