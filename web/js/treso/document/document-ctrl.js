'use strict';
var documentApp = angular.module('DocumentApp', ['Portail', 'ngResource']);

documentApp.controller('documentCtrl', function($scope, $filter, $location, Documents, documentsPerPage) {
    $scope.documents = []
    Documents.query().$promise.then(function(result) {
      $scope.documents = result;
    });
    $scope.date = {start: 0, end: undefined, selectedRange: undefined};
    $scope.allowed_types = {t: null};
    $scope.search = {nom: null};
    $scope.types = [];
    $scope.documentsPerPage = documentsPerPage;
    $scope.pagination = {offset: 0, end: documentsPerPage};

    $scope.rangeSelected = function() {
      if ($scope.date.selectedRange == undefined)
        return false;
      return $scope.date.selectedRange.year != undefined;
    };

    $scope.updateDocumentList = function() {
      var filtered = $filter('int_range')($scope.documents, 'date_ajout', $scope.date.start, $scope.date.end);
      if ($scope.search.nom != null && $scope.search.nom != "") {
        filtered = $filter('filter')(filtered, $scope.search);
      }

      $scope.types = $filter('unique')(filtered, 'type');

      if ($scope.allowed_types.t == null || $scope.allowed_types.t.length == 0) { // ça n'a pas de sens de filtrer si on sait qu'on aura aucun resultat
          $scope.filteredDocuments = filtered;
      } else {
        $scope.filteredDocuments = $filter('filter')(filtered, function(doc, index) {
          return $scope.allowed_types.t.indexOf(doc.type) >= 0; // le "in_array" de javascript
        });
      }
      //$location.search({nom: $scope.search.nom, date: ...}); // pour manipuler l'historique quand on effectue un filtrage
    }
    $scope.$watch('date.start', $scope.updateDocumentList);
    $scope.$watch('date.end', $scope.updateDocumentList);
    $scope.$watch('search.nom', $scope.updateDocumentList);
    $scope.$watch('documents', $scope.updateDocumentList);
    $scope.$watch('allowed_types.t', $scope.updateDocumentList);
});

documentApp.factory('Documents', ['$resource', 'baseUrl',
    function ($resource, baseUrl) {
        return $resource(baseUrl, {}, {
            query: {method: 'GET', isArray: true}
        });
    }]);

documentApp.value('documentsPerPage', 20);