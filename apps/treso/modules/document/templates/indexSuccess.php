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
      'type' => $document->DocumentType->getNom(),
      'url' => url_for('document_show', $document),
      'transaction' => $transaction,
      );
} ?>
<script type="text/javascript">
function documentCtrl($scope) {
    $scope.documents = <?php echo json_encode($docs); ?>;
    $scope.opened = false;
    $scope.date = {start: 0, end: undefined};
    $scope.rangeSelected = function() {
      if ($scope.selectedRange == undefined)
        return false;
      return $scope.selectedRange.year != undefined;
    };
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
.dropdown-menu {
  padding: 4px;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  border: 1px solid #ddd !important;
  -moz-box-shadow: 2px 2px 5px #888;
  -webkit-box-shadow: 2px 2px 5px #888;
}

.date-range table {
  width: 100%;
}

.date-range td button {
  background-image: none;
  background-color: transparent;
  border-width: 0px;
  text-shadow: none;
  box-shadow: none;
  width: 100%;
}

.date-range td button:hover {
  background-color: #eeeeee;
}

.date-range td button.active {
  background-color: #006dcc;
  color: white;
}

.date-range h1 {
  font-size: 20px;
  font-weight: 500;
}

.date-range hr {
  margin: 5px 0px;
}

.date-range .btn-group button {
  width: 50%;
}
.date-range td, .date-range td:hover {
  border: none;
  background-color: white !important;
}
.date-range tr, .date-range tr:hover {
  border: none;
  background-color: white !important;
}
</style>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th><portail-dropdown>
            <button class="btn dropdown-toggle" portail-dropdown-trigger>
              <span ng-if="!rangeSelected()">Date</span>
              <span ng-if="rangeSelected()">{{ selectedRange.month }} {{ selectedRange.year }}</span>
              <i class="caret"></i></button>
            <portail-dropdown-content style="width: 300px">
              <portail-date-range header="Filtrer par date" selection="selectedRange" start="date.start" end="date.end"></portail-date-range>
            </portail-dropdown-content>
          </portail-dropdown>
      </th>
      <th>Nom <div class="pull-right"><input ng-model="search.nom" type="text" placeholder="Recherche"/></div></th>
      <th>Type</th>
      <th>Transaction</th>
    </tr>
  </thead>
  <tbody>
    <tr ng-repeat="document in documents | filter:search | int_range:'date_ajout':date.start:date.end">
      <td class="reduce">{{ document.date_ajout * 1000 | date:'d MMMM yyyy' }}</td>
      <td class="expand"><a href="{{ document.url }}" target="_blank">{{ document.nom }}</a></td>
      <td class="reduce">{{ document.type }}</td>
      <td class="reduce"><a ng-if="document.transaction != null" href="{{ document.transaction.url }}">{{ document.transaction.libelle }}</a></td>
    </tr>
  </tbody>
</table>

</div>