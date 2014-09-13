'use strict';

function isClear(val) {
    return val == undefined || val == ''
}

angular.module('Portail', [])
.filter('int_range', function() {
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
})
.filter('slice', function() {
    return function(array, start, end) {
        if (!angular.isArray(array)) return array;

        return array.slice(start, end);
    }
})
.filter('cut', function() {
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
})
.filter('capitalize', function() {
    return function(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    };
})
.filter('unique', function() {
    var cache = {};
    return function(array, attr) {
        if (!angular.isArray(array)) return array;

        if(array.$$uniqueFilter == undefined)
            array.$$uniqueFilter = [];

        array.$$uniqueFilter.length = 0;
        for ( var j = 0; j < array.length; j++) {
            var value = array[j][attr];
            var found = false;
            for ( var i = 0; i < array.$$uniqueFilter.length; i++) {
                if (array.$$uniqueFilter[i] == value) {
                    found = true;
                    break;
                }
            }
            if (!found) {
                array.$$uniqueFilter.push(value);
            }
        }

        return array.$$uniqueFilter;
    }
})
.filter('in_array', function() {
    return function(source, attr, array) {
        if (!angular.isArray(source) || !angular.isArray(array))
            return source;

        var filtered = [];
        for ( var j = 0; j < source.length; j++) {
            var value = source[j][attr];
            var found = false;
            for ( var i = 0; i < array.length; i++) {
                if (array[i] == value) {
                    found = true;
                    break;
                }
            }
            if (!found) {
                filtered.push(source[j]);
            }
        }
        return filtered;
    }
})
.directive('portailDateRange', function($locale) {
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
        '<button class="btn" ng-click="cancel()">Annuler</button>'+
        '</div>'+
        '</div>',
    scope: {
      start: '=',
      end: '=',
      selected: '=selection',
      header: '@'
    },
    require: '?^portailDropdown',
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
        };
        $scope.ok = function() {
            $scope.close();
        }
        $scope.cancel = function() {
            $scope.reset();
            $scope.close();
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
    },
    link: function(scope, element, attrs, ctrl) {
        scope.close = function() {
            if (ctrl != null && ctrl.close != undefined)
                setTimeout(ctrl.close, 0);
        };
    }
  }
})
.directive('portailDropdown', function() {
  return {
    restrict: 'E',
    replace: true,
    transclude: true,
    template: '<div class="btn-group" ng-class="{open: opened}" ng-transclude></div>',
    scope: {},
    controller: function ($scope, $element) {
        $scope.opened = false;

        // handler pour détecter les clics hors du dropdown et le fermer
        var clickHandler = function() {
            $scope.opened = false;
            $scope.update();
        };
        $scope.$watch('opened', function(value) {
            if ($scope.opened) {
                // si on ajoute l'handler immédiatement il sera déclenché
                // à cause du clic sur le trigger
                // donc on attend la fin de la boucle d'évènements
                setTimeout(function() {
                    angular.element("html").bind('click', clickHandler);
                }, 0);
            } else {
                angular.element("html").unbind('click', clickHandler);
            }
        })
        this.toggle = function () {
            $scope.opened = !$scope.opened;
            $scope.update();
        }
        this.setContent = function (contentScope) {
            $scope.content = contentScope;
        }
        $scope.update = function () {
            $scope.content.update($scope.opened);
            $scope.$apply();
        }
        this.close = function () {
            $scope.opened = false;
            $scope.update();
        }
    }
  }
})
.directive('portailDropdownContent', function() {
  return {
    restrict: 'E',
    replace: true,
    transclude: true,
    require: '^portailDropdown',
    template: '<div class="dropdown-menu" ng-transclude></div>',
    scope: true,
    link: function (scope, element, attrs, dropCtrl) {
        dropCtrl.setContent(scope);
        element.on('click', function(event) {
            event.stopPropagation();
        });
        scope.update = function(value) {
            if (value)
                element.css('display', 'block');
            else
                element.css('display', 'none');
        }
    }
  }
})
.directive('portailDropdownTrigger', function() {
  return {
    restrict: 'A',
    scope: {},
    require: '^portailDropdown',
    link: function (scope, element, attrs, dropCtrl) {
        element.bind('click', function() {
            dropCtrl.toggle();
        });
    }
  }
})
.directive('portailTypesChooser', function() {
  return {
    restrict: 'E',
    replace: true,
    template: '<div class="types-chooser">'+
                '<ul class="unstyled checkbox-list">'+
                  '<li ng-repeat="type in types">'+
                    '<label><input type="checkbox" checked="checked" ng-click=""/>{{ type }}</label>'+
                  '</li>'+
                '</ul>'+
                '<div class="btn-group">'+
                  '<button ng-click="close" class="btn half-button">Select All</button>'+
                  '<button ng-click="close" class="btn half-button">Unselect All</button>'+
                '</div>'+
                '<div class="btn-group">'+
                  '<button ng-click="close()" class="btn full-button">Ok</button>'+
                '</div>'+
              '</div>',
    require: ['ngModel', '?^portailDropdown'],
    scope: {
        types: '=',
    },
    controller: function ($scope, $element) {},
    link: function (scope, element, attrs, ctrls) {
        scope.close = function() {
            if (ctrls[1] != null && ctrls[1].close != undefined)
                setTimeout(ctrls[1].close, 0);
        };
    }
  }
});