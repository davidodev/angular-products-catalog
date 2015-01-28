

var app = angular.module('catalog', ['ui.bootstrap','ui.sortable','ui.router','angularUtils.directives.dirPagination','ngCkeditor'])

.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider){
'use strict';

	//$urlRouterProvider.otherwise("/");

  $stateProvider
    .state('index', {
      url: "",
      templateUrl: "products.html"
    })
    .state('products', {
      url: "/",
      templateUrl: "products.html"
    })
    .state('categories', {
      url: "/categories",
      templateUrl: "categories.html"
    })
    .state('settings', {
      url: "/settings",
      templateUrl: "settings.html"
    });

}])

.run(['$rootScope', function($rootScope){
'use strict';

	$rootScope.requestPath = '../index.php?';

}]);
