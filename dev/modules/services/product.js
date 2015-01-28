
app.factory('productService', ['$rootScope', '$http', '$q', function($rootScope, $http, $q){
'use strict';

      var factory = {};
      var path = $rootScope.requestPath;

      var parseStatus = function(status, fixed, method){
        var $notify,
            pos,
            text,
            alert;

        if(status == 'success' && method == 'update')
          text = 'Zmiany zostały zapisane.';

        else if(status == 'success' && method == 'add')
          text = 'Produkt został dodany.';

        else if(status == 'success' && method == 'delete')
          text = 'Produkt został usunięty.';

        else if(status == 'error' && method == 'update')
          text = 'Wystąpił błąd. Zmiany nie zostały zapisane.';

        else if(status == 'error' && method == 'add')
          text = 'Wystąpił błąd. Produkt nie zostały dodany.';

        else if(status == 'error' && method == 'delete')
          text = 'Wystąpił błąd. Produkt nie zostały usunięty.';

        else{
          text = 'Wystąpił nieznany błąd. Spróbuj ponownie później. Kod błędu: ' + status;
          status = 'error';
        }

        if(fixed){
          $notify = $;
          pos = "right top";

        }else{
          $notify = $('.btn-alert');
          pos = "left";
        }

        $notify.notify(text, {className: status, position: pos });
        
        if(status == 'success')
          return true;
        else
          return false;
      }


      factory.update = function (data){

        return $http.post(path + 't=catalog&action=ajax-save-product&noheader=true&id=' + data.id , data.data)
        .then(function(response){
          return parseStatus(response.data.status, data.fixedNotify, 'update');
          
        }, function(error){
          return parseStatus(error.status, data.fixedNotify, 'update');
        });
      }


      factory.add = function (data){

        return $http.post(path + 't=catalog&action=ajax-save-product&noheader=true', data.data)
        .then(function(response){
          return parseStatus(response.data.status, data.fixedNotify, 'add');
          
        }, function(error){
          return parseStatus(error.status, data.fixedNotify, 'add');
        });
      }

      factory.delete = function(data){

        return $http.post(path + 't=catalog&action=ajax-delete-product&noheader=true', {id: data.data.p_id})
        .then(function(response){
          return parseStatus(response.data.status, data.fixedNotify, 'delete');
          
        }, function(error){
          return parseStatus(error.status, data.fixedNotify, 'delete');
        });
      }


      return factory;
}]);
