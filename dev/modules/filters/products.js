

app.filter('productsFilter', [function(){

  return function(products, filter_category_id) {
    
    if(!angular.isUndefined(products) && !angular.isUndefined(filter_category_id))
      return products.filter(function(product) {
      
        for (var i in product.parents) 
          if (filter_category_id.indexOf(product.parents[i]) != -1) 
            return true;
        
        return false;
      });
      
    else
      return products;
  };
}]);

