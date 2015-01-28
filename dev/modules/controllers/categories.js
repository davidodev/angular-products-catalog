
app.controller('categoriesController', ['$scope','$rootScope', '$modal', '$http', '$parse', 'paginationService', '$filter', 
function($scope, $rootScope, $modal, $http, $parse, paginationService, $filter){
'use strict';


  /* init scope
  // ----------------------------------------*/
  $scope.isready = false;
  $scope.categories = [];
  

  /* get products
  // ----------------------------------------*/
  $http.get($rootScope.requestPath + 't=catalog&action=ajax-get-tree-categories&noheader=true&parent_id=1')
  .success(function(response) {

    //$scope.currentPage = 1;
    $scope.categories = response;
    $scope.totalItems = response.length;

    //$scope.itemPerPage = 15;

    $rootScope.orderCategories('c_id',false);
 
  });


  /* get config
  // ----------------------------------------*/
  $http.get($rootScope.requestPath + 't=catalog&action=ajax-get-config&noheader=true')
  .success(function(response) {

    $rootScope.conf = response;
    $rootScope.conf.desc_category = Number(response.desc_category);
    console.log('desc: ' + $rootScope.conf.desc_category);

  });


  /* add product
  // ----------------------------------------*/
  $scope.addCategory = function(){

    $rootScope.category = {};

    // default parent category
    $rootScope.category.pc_id = 1;
    // default visible category
    $rootScope.category.visible = 1;
    // reset scope for new category
    $rootScope.category.c_id = undefined;
    $rootScope.category.meta = 0;
    $rootScope.category.name = '';
    $rootScope.category.desc = '<p>tu tekst zajawki</p><p>*****</p><p>tu opis</p>';
    $rootScope.category.featuredImage = [];

    var modalOptions = {
      title :               'Dodaj nową kategorie',
      btnConfirm :          'Dodaj kategorie',
      btnConfirmAndClose :  'Dodaj i zamknij'
    };

    var modalInstance = $modal.open({
      templateUrl: 'view/category.html',
      controller: 'categoryController',
      size: 'lg',
      backdrop: 'static',
      resolve: {
            modalOptions: function(){
                            return modalOptions;
                          },
            categories: function(){
                          return $scope.categories;
                        }
      }
    });
  };
  


  /* edit category
  // ----------------------------------------*/
  $scope.editCategory = function(category){

    $rootScope.category = category;
    $rootScope.category.visible = Number(category.visible);

    //console.log('ilosc zdjec: ' + category.photos_other.length);

    if(!category.featuredImage){
      console.log('Brak miniatury kategorii');
      $rootScope.category.featuredImage = [];
    }

    var modalOptions = {
      title:               'Edytuj kategorie',
      btnConfirm:          'Zapisz zmiany',
      btnConfirmAndClose:  'Zapisz i zamknij'
    };

    var modalInstance = $modal.open({
      templateUrl: 'view/category.html',
      controller: 'categoryController',
      size: 'lg',
      backdrop: 'static',
      resolve: {
            modalOptions: function(){
                            return modalOptions;
                          },
            categories: function(){
                            return $scope.categories;
                          }
      }
    });
  };


  $scope.deleteCategory = function(id){

    console.log('Usuwanie kategorii');

    var conf = confirm("Czy na pewno chcesz usunąć kategorie ?");

    toDelete = $scope.products[id];

    if(conf)
    categoryService.delete({data: toDelete, fixedNotify: true})
    .then(function(response){
      if(response)
        $scope.categories.splice(id, 1);
    });
  };


  /* show/hide category
  // ----------------------------------------*/
  $scope.toggleVisible = function(category){
    
    category.visible = Number(category.visible) === 0 ? 1: 0;

    console.log('widoczny: ' + category.visible);
    
    $http.post($rootScope.requestPath + 't=catalog&action=ajax-save-category&type=single-value&noheader=true&id=' + category.c_id, 
    {visible: category.visible})

    .success(function(response){
      console.log('Status ' + response.status);
    })

    .error(function(){
      console.log('Błąd zapisu produkt id = ' + id);
    });
  };


  /* reorder categories after add or update
  // ----------------------------------------*/
  $rootScope.orderCategories = function(order, reverse) {
    $scope.categories = $filter('orderBy')($scope.categories, order, reverse);
  };
  

  $scope.setCurrentPage = function(i = 1){
    $scope.currentPage = i;
  }


  jQuery('#catalog-wrap .input-current-page').on('click', function(){
    $(this).select();
  });

}]);