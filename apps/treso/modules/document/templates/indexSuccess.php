<?php use_helper('Date', 'Text');

use_javascript('treso/common/portail.js');
use_javascript('treso/document/document-ctrl.js');
?>
<script type="text/javascript">
documentApp.constant('baseUrl', "<?php echo url_for('documents_list', array('login' => $asso->getLogin(), 'sf_format' => 'json')) ?>");
</script>

<div ng-app="DocumentApp" ng-controller="documentCtrl">
<div class="pull-left" style="margin-right:20px;"><h1>Stockage de documents</h1></div>
<div><a href="<?php echo url_for('document_new', $asso) ?>" class="btn btn-primary btn-large">Ajouter un document</a></div>

<style type="text/css">
.table input {
  margin-bottom: 0;
}
.table thead th {
  vertical-align: top;
}
</style>

<table ng-if="documents.length > 0" class="table table-striped table-bordered table-documents">
  <thead>
    <tr>
      <th class="column-date"><portail-dropdown>
            <button class="btn dropdown-toggle" portail-dropdown-trigger>
              <span ng-if="!rangeSelected()">Date</span>
              <span ng-if="rangeSelected()">{{ date.selectedRange.month | capitalize }} {{ date.selectedRange.year }}</span>
              <i class="caret"></i></button>
            <portail-dropdown-content style="min-width: 300px">
              <portail-date-range header="Filtrer par date" selection="date.selectedRange" start="date.start" end="date.end"></portail-date-range>
            </portail-dropdown-content>
          </portail-dropdown>
      </th>
      <th class="column-nom">Nom <div class="pull-right"><input ng-model="search.nom" type="text" placeholder="Recherche..." auto-focus/></div></th>
      <th class="column-type"><portail-dropdown>
            <button class="btn dropdown-toggle" portail-dropdown-trigger>Type <span ng-if="allowed_types.t.length > 0">({{ allowed_types.t.length }})</span> <i class="caret"></i></button>
            <portail-dropdown-content>
              <portail-options-chooser options="types" selected="allowed_types" />
            </portail-dropdown-content>
      </th>
      <th class="column-transaction">Transaction</th>
    </tr>
  </thead>
  <tbody>
    <tr ng-repeat="document in filteredDocuments | slice : pagination.offset : pagination.end">
      <td class="column-date">{{ document.date_ajout * 1000 | date:'d MMMM yyyy' }}</td>
      <td class="column-nom"><a href="{{ document.url }}" target="_blank">{{ document.nom }}</a></td>
      <td class="column-type">{{ document.type }}</td>
      <td class="column-transaction"><a ng-if="document.transaction != null" href="{{ document.transaction.url }}">{{ document.transaction.libelle }}</a></td>
    </tr>
    <tr ng-if="filteredDocuments.length == 0">
      <td colspan="4" style="text-align:center;">Aucun document ne correspond à ces critères.</td>
    </tr>
  </tbody>
</table>

<div style="text-align:center;">
  <portail-paginator source="filteredDocuments" max-per-page="documentsPerPage" report-in="pagination" />
</div>

<div ng-if="documents.length == 0">
  <h2 style="text-align:center;">Aucun document stocké</h2>
  <p>Vous pouvez stocker ici tous les documents de votre asso : Changement de bureau, nouveaux status, devis, factures, attestation de dépôt de chèques à la banque...</p>
  <p>Cet espace n'est pas réservé aux PDFs, vous pouvez stocker le fichier excel récapitulatif d'une commande par exemple.</p>
  <p>En stockant vos documents ici vous serez sûr de ne pas les perdre et, si besoin, vous (et vos successeurs) pourrez retrouver facilement un documment grâce au système de recherche pas date, nom et type.</p>
  <p>Les documents stockés ici sont aussi accessibles depuis le "Z:/" de votre asso.</p>
</div>

</div>