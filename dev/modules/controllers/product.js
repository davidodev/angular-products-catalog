
app.controller('productController', ['$scope','$rootScope','$http','$parse','$modalInstance','modalOptions','productService','products', 
function($scope, $rootScope, $http, $parse, $modalInstance, modalOptions, productService, products){
'use strict';


  $scope.TextEditorReady = false;
  $scope.folderThumb = "files/thumbs/";
  var sizeXImage = "800";
  var sizeYImage = "600";
  var productBeforeUpdate = {};

  $modalInstance.opened.then(function () {

    $scope.modalOptions = modalOptions;

    productBeforeUpdate.name            = $rootScope.product.name;
    productBeforeUpdate.category_name   = $rootScope.product.category_name;
    productBeforeUpdate.visible         = $rootScope.product.visible;

    $scope.$on("ckeditor.ready", function(event) {
      $scope.TextEditorReady = true;

    });
    
  });


  /* real update (not after save) list product when edit category in product
  // ----------------------------------------*/
  $rootScope.$watch('product.c_id', function() {

    getCategory($rootScope.product.c_id).then(function(response){
      $rootScope.product.category_name  = response.name; 
      $rootScope.product.parents        = response.parents; 

    });

  });


  /* it must be improve
  // ----------------------------------------*/
  var getCategory = function(id){

    return $http.get($rootScope.requestPath + 't=catalog&action=ajax-get-category&noheader=true&c_id=' + id)
    .then(function(response){
      return response.data;
      
    });

  }


  /* save product
  // ----------------------------------------*/
  $scope.saveProduct = function(product, close){
    
    $scope.saveprocess = true;
    var fixedNotify = (close) ? true : false;

    if(product.p_id){ // then update

      productService.update({data: product, id: product.p_id, fixedNotify: fixedNotify})
      .then(function(response){

        console.log('status update - ' + product.name + ': ' + response);

        if(response){
          $rootScope.orderProducts('c_id',false);
          productBeforeUpdate = product;
        }

        $scope.saveprocess = false;

      });

    }else{ // then add

      productService.add({data: product, fixedNotify: fixedNotify})
      .then(function(response){

        console.log('status add - ' + product.name + ': ' + response);

        if(response){
          products.push(product);
          $rootScope.orderProducts('c_id',false);
          productBeforeUpdate = product;
        }

        $scope.saveprocess = false;

      });

    }

    if(close == true)
      $modalInstance.close('close');
      
  };


  $scope.discardProduct = function () {

    console.log('discardProduct: ' + productBeforeUpdate.name);

    $rootScope.product.name           =  productBeforeUpdate.name;
    $rootScope.product.category_name  =  productBeforeUpdate.category_name;
    $rootScope.product.visible        =  productBeforeUpdate.visible;

    $modalInstance.dismiss('cancel');

  };


  $scope.cancelProduct = function () {
    $modalInstance.dismiss('cancel');
  };

}]);