
app.controller('categoryController', ['$scope','$rootScope','$http','$parse','$modalInstance','modalOptions','categoryService','categories', 
function($scope, $rootScope, $http, $parse, $modalInstance, modalOptions, categoryService, categories){
'use strict';


  /* init scope and var
  // ----------------------------------------*/
  var categoryBeforeUpdate = {},
      sizeXImage = "800",
      sizeYImage = "600";

  $scope.folderImage = "katalog/";
  $scope.folderThumb = "files/thumbs/";


  $modalInstance.opened.then(function () {
    $scope.modalOptions = modalOptions;

    categoryBeforeUpdate.name 	= $rootScope.category.name;
    categoryBeforeUpdate.visible  = $rootScope.category.visible;

    $scope.$on("ckeditor.ready", function(event) {
      $scope.TextEditorReady = true;
    });
    
  });



  // real update (not after save) list categories when edit parent category in category
  // ----------------------------------------
  // $rootScope.$watch('category.pc_id', function() {
  //   getCategory($rootScope.category.c_id).then(function(data){

  //     $rootScope.category.category_name  = data.category_name; 
  //     $rootScope.category.c_ids          = data.c_ids; 

  //   });

  // });


  // it must be improve
  // ----------------------------------------
  var getCategory = function(id){
    return $http.get($rootScope.requestPath + 't=catalog&action=ajax-get-category&noheader=true&c_id=' + id)
    .then(function(response){
      return response.data;
    });

  }


  $scope.saveCategory = function(category, close){
    
    $scope.saveprocess = true;
    var fixedNotify = (close) ? true : false;

    if(category.c_id){ // then update

      categoryService.update({data: category, id: category.c_id, fixedNotify: fixedNotify})
      .then(function(response){

        if(response){
        	categoryBeforeUpdate = category;
          $rootScope.orderCategories('c_id',false);
        }

        $scope.saveprocess = false;

      });

    }else{ // then add

      categoryService.add({data: category, fixedNotify: fixedNotify})
      .then(function(response){

        if(response){
          if(category.pc_id = 1)
            categories.push(category);
          else
            categories[$scope.parent].push(category);

          categoryBeforeUpdate = category;
          $rootScope.orderCategories('c_id',false);
        }

        $scope.saveprocess = false;

      });

    }

    if(close == true)
      $modalInstance.close('close');
      
  };


  $scope.discardCategory = function () {

    console.log('discardCategory: ' + categoryBeforeUpdate.name);

    $scope.category.name 	= categoryBeforeUpdate.name;
    $scope.category.visible = categoryBeforeUpdate.visible;

    $modalInstance.dismiss('cancel');

  };


  $scope.cancelCategory = function () {
    $modalInstance.dismiss('cancel');
  };


}]);