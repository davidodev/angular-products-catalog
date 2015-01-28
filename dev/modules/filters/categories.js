


// do dopracowania
app.filter('categoriesFilter', ['$filter', '$parse', function($filter, $parse){
"use strict";


  return function(categories, filter_category_id) {

    var newArray = [];
    
    if(!angular.isUndefined(categories) && !angular.isUndefined(filter_category_id)){

      for(var key in categories){

          var value = categories[key];
          $parse(categories[key])(scope).$destroy();

          var inArr = false;
          for (var i in value.c_ids)
          if (filter_category_id.indexOf(value.c_ids[i]) != -1)
            inArr = true;

          if(inArr){
            newArray.push(value);
          }else {
            //var valuex = new Object();
            //valuex.children = $filter('categoriesFilter')(value.children);
            //newArray.push(valuex);
          }
          
      }


    return newArray;

    }else

      return categories;


  

  }
  



}]);

