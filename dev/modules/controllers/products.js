
app.controller('productsController', ['$scope','$rootScope','$modal','$http','$parse','paginationService','$filter','productService', 
function($scope, $rootScope, $modal, $http, $parse, paginationService, $filter, productService){
"use strict";


  /* init scope
  // ----------------------------------------*/
  $scope.isready = false;
  $scope.products = [];
  $rootScope.categories = [];


  /* get products
  // ----------------------------------------*/
  $http.get($rootScope.requestPath + 't=catalog&action=ajax-get-products&noheader=true')
  .success(function(response) {

    $scope.currentPage = 1;
    $scope.products = response.products;
    $scope.totalItems = response.products.length;

    $rootScope.conf = response.config;

    $rootScope.conf.desc_product = Number(response.config.desc_product);

    $scope.itemPerPage = 15;

    $rootScope.orderProducts('c_id', false);


  });


  /* get categories
  // ----------------------------------------*/
  $http.get($rootScope.requestPath + 't=catalog&action=ajax-get-tree-categories&noheader=true&parent_id=1')
  .success(function(response) { $rootScope.categories = response; });
  
  
  /* add product
  // ----------------------------------------*/
  $scope.addProduct = function(){

    $rootScope.product = {};

    $rootScope.product.id = undefined;
    $rootScope.product.c_id = 1;
    $rootScope.product.name = '';
    $rootScope.product.desc = '<p>tu tekst zajawki</p><p>*****</p><p>tu opis produktu</p>';
    $rootScope.product.visible = 1;
    $rootScope.product.meta = 0;

    $rootScope.product.images = [];

    var modalOptions = {

      title :               'Dodaj nowy produkt',
      btnConfirm :          'Dodaj produkt',
      btnConfirmAndClose :  'Dodaj i zamknij'

    };

    var modalInstance = $modal.open({

      templateUrl: 'view/product.html',
      controller: 'productController',
      size: 'lg',
      backdrop: 'static',
      resolve: {

        modalOptions: function(){
                        return modalOptions;
                      },
        products: function(){
                    return $scope.products;
                  }
      }

    });
  };
  

  /* edit product
  // ----------------------------------------*/
  $scope.editProduct = function(product){

    $rootScope.product = product;
    $rootScope.product.visible = Number(product.visible);

    console.log('ilosc zdjec: ' + product.images.length);

    if(!product.images){
      console.log('Brak zdjęć produktu');
      $rootScope.product.images = [];
    }

    var modalOptions = {

      title:               'Edytuj produkt',
      btnConfirm:          'Zapisz zmiany',
      btnConfirmAndClose:  'Zapisz i zamknij'

    };

    var modalInstance = $modal.open({

      templateUrl: 'view/product.html',
      controller: 'productController',
      size: 'lg',
      backdrop: 'static',
      resolve: {

        modalOptions: function(){
                        return modalOptions;
                      },
        products: function(){
                    return $scope.products;
                  }
      }

    });
  };


  $scope.deleteProduct = function(index){

    console.log('Usuwanie produktu');

    var id = ($scope.currentPage - 1) * $scope.itemPerPage + index;

    var toDelete = $scope.products[id];

    var conf = confirm("Czy napewno chcesz usunąć produkt: " + toDelete.name + " ?");

    if(conf)
    productService.delete({data: toDelete, fixedNotify: true})
    .then(function(response){

      if(response)
        $scope.products.splice(id, 1);

    });

  };


  /* i was think of another filter...
  // ----------------------------------------*/
  //$scope.$watch('products', function(){

      //$scope.orderProducts('c_id',false);
  //  $scope.products = $filter('filterCats')($scope.products);
    //$scope.$apply();
  //});
  
  
  /* show/hide product
  // ----------------------------------------*/
  $scope.toggleShow = function(product){
    
    $scope.product = product;
    /* backend is wrong
    // ---------------------------------------- */
    $scope.product.visible = Number($scope.product.visible) === 0 ? 1: 0;

    console.log('widoczny: ' + $scope.product.visible);
    
    $http.post($rootScope.requestPath + 't=catalog&action=ajax-save-product&type=single-value&noheader=true&cid=1&id=' + $scope.product.p_id, 
    {visible: $scope.product.visible})

    .success(function(response){
      console.log('Status ' + response.status);
      $scope.saveprocess = false;
      
    })
    .error(function(){
      console.log('Błąd zapisu produkt id = ' + id);
      $scope.saveprocess = false;
      
    });
  };
  

  $rootScope.orderProducts = function(order, reverse) {
    $scope.products = $filter('orderBy')($scope.products, order, reverse);
  };


  $scope.setCurrentPage = function(i = 1){
    $scope.currentPage = i;
  };


  jQuery('#catalog-wrap .input-current-page').on('click', function(){
    $(this).select();
  });

  /* probably to delete
  // ----------------------------------------*/
  // $scope.setCategoryName = function(id){
  
  //   $http.get('index.php?t=catalog&action=ajax-get-category&noheader=true&c_id=' + id)
  //   .success(function(response){ return response.category_name; });

  // }

}]);