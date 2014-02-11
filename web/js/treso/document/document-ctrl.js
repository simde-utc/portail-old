'use strict';
var documentApp = angular.module('DocumentApp', []);

function isClear(val) {
    return val == undefined || val == ''
}

documentApp.filter('int_range', function() {
    return function(array, attr, start, end) {
        if (!angular.isArray(array)) return array;

        if (isClear(start) && isClear(end)) return array;

        if (isClear(start))
            start = -Infinity; // pas de filtre inférieur
        else
            start = parseInt(start);

        if (isClear(end))
            end = Infinity; // pas de limite supérieure
        else
            end = parseInt(end);

        var filtered = [];
        for ( var j = 0; j < array.length; j++) {
            var value = array[j][attr];
            if (value >= start && value <= end) {
                filtered.push(array[j]);
            }
        }
        return filtered;
    }
});

documentApp.filter('unique', function() {
    return function(array, attr) {
        if (!angular.isArray(array)) return array;

        var filtered = [];
        for ( var j = 0; j < array.length; j++) {
            var value = array[j][attr];
            var found = false;
            for ( var i = 0; i < filtered.length; i++) {
                if (filtered[i] == value) {
                    found = true;
                    break;
                }
            }
            if (!found) {
                filtered.push(value);
            }
        }
        return filtered;
    }
});

documentApp.filter('slice', function() {
    return function(array, start, end) {
        if (!angular.isArray(array)) return array;

        return array.slice(start, end);
    }
});

documentApp.filter('cut', function() {
    var cache = {};
    return function(array, len) {
        if (!angular.isArray(array)) return array;

        if (cache[array] != undefined && cache[array][len] != undefined)
            return cache[array][len];

        var alen = array.length;
        var result = [];
        for (var i = 0; i < alen; i+=len) {
            result.push(array.slice(i, i + len));
        }

        if (cache[array] == undefined) 
            cache[array] = {};
        cache[array][len] = result;

        return result;
    }
});

documentApp.filter('capitalize', function() {
    return function(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    };
});

documentApp.directive('portailDateRange', function($locale) {
  return {
    restrict: 'E',
    replace: true,
    template: '<div class="date-range">'+
        '<h1>{{ header }}</h1>'+
        '<hr/>'+
        '<table>'+
        '<tr>'+
        '<td><button ng-click="yearsBefore()" title="Années précédentes" class="btn">&lt;</button></td>'+
        '<td ng-repeat="year in years"><button ng-class="{active: selected.year == year}" ng-click="selectYear(year)" class="btn">{{ year }}</button></td>'+
        '<td><button ng-click="yearsAfter()" title="Années suivantes" class="btn" ng-class="{disabled: includesCurrentYear()}">&gt;</button></td>'+
        '</tr>'+
        '</table>'+
        '<table>'+
        '<tr ng-repeat="months_part in months | cut:4">'+
        '<td ng-repeat="month in months_part"><button class="btn" ng-class="{active: selected.month == month}" ng-click="selectMonth(month)">{{ month | capitalize }}</button></td>'+
        '</tr>'+
        '</table>'+
        '<hr/>'+
        '<div class="btn-group">'+
        '<button class="btn" ng-click="ok()">Ok</button>'+
        '<button class="btn" ng-click="reset()">Annuler</button>'+
        '</div>'+
        '</div>',
    scope: {
      start: '=',
      end: '=',
      selected: '=selection',
      header: '@'
    },
    controller: function($scope) {
        $scope.genYears = function(max) {
            $scope.years = [];
            for (var i = $scope.nbYears - 1; i >= 0; i--)
                $scope.years.push(max - i);
        };

        $scope.selected = {year: undefined, month: undefined};
        $scope.today = new Date();
        $scope.nbYears = 3;
        $scope.genYears($scope.today.getFullYear());

        $scope.months = $locale.DATETIME_FORMATS.MONTH;

        // renvoie true si l'interval d'années contient l'année actuelle
        $scope.includesCurrentYear = function() {
            return $scope.years.indexOf($scope.today.getFullYear()) > -1;
        }
        $scope.yearsBefore = function() {
            $scope.genYears($scope.years[0]);
        };
        $scope.yearsAfter = function() {
            if ($scope.years[$scope.nbYears - 1] == $scope.today.getFullYear())
                return;

            $scope.genYears($scope.years[$scope.nbYears - 1] + $scope.nbYears - 1);
        };
        $scope.selectYear = function(year) {
            // si on clique sur l'année active on désactive le filtre
            if ($scope.selected.year == year)
                return $scope.reset();

            // on annule d'abord la sélection du mois
            $scope.selected.month = undefined;
            $scope.selected.year = year;
            $scope.computeLimits();
        };
        $scope.selectMonth = function(month) {
            // si on lique sur le mois actif on désactive le filtre
            if ($scope.selected.month == month) {
                $scope.selected.month = undefined;
                return $scope.computeLimits();
            }

            // si aucune année n'est sélectionnée on choisit l'année actuelle
            if (isClear($scope.selected.year))
                $scope.selected.year = $scope.today.getFullYear();

            $scope.selected.month = month;
            $scope.computeLimits();
        };
        $scope.reset = function() {
            $scope.selected.year = undefined;
            $scope.selected.month = undefined;
            $scope.computeLimits();
            $scope.$emit('close');
        };
        $scope.ok = function() {
            $scope.$emit('close');
        }
        $scope.computeLimits = function() {
            // calcule start et end à partir de selected
            if ($scope.selected.year != undefined) {
                var start, end;
                if ($scope.selected.month != undefined) {
                    // on sélectionne un seul mois
                    var monthi = $scope.months.indexOf($scope.selected.month);
                    start = new Date($scope.selected.year, monthi);
                    end = new Date($scope.selected.year, monthi + 1);
                } else {
                    // on sélectionne une année entière
                    start = new Date($scope.selected.year, 0);
                    end = new Date($scope.selected.year + 1, 0);
                }
                $scope.start = start.getTime() / 1000;
                $scope.end = end.getTime() / 1000 - 1;
            } else {
                $scope.start = undefined;
                $scope.end = undefined;
            }
        }
    }
  }
});

documentApp.directive('visible', function() {
    return {
        restrict: 'A',
        scope: {
            'visible': '='
        },
        link: function(scope, element, attrs) {
            scope.$watch('visible', function(newv, oldv) {
                if (newv) {
                    element.css('display', 'block');
                } else {
                    element.css('display', 'none');
                }
            });
        }
    }
});
