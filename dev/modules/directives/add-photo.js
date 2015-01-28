
app.directive('addPhoto', ['$rootScope', function($rootScope){
'use strict';

  return {
      scope: {
          addPhoto: '='
      },
      link: addPhotoLink
  }


  function addPhotoLink (scope, element, attrs) {

    var multiple = false,
        wait = angular.element('<div id="wait"></div>'),
        img,
        newurl;

        if(attrs.multiple != undefined)
          multiple = true;

        console.log('multi: ' + multiple);

    var ClickCallback = function(){
      window.KCFinder = {

        callBack: function(url) {
          window.KCFinder = null;
          $('#wait').show();
      
          newurl = url.substring(1, url.length);
          img = new Image();
          img.src = '../../' + newurl;
         
          img.onload = function() {
            if(multiple)
              scope.addPhoto.push(newurl);
            else
              scope.addPhoto = newurl;
            scope.$apply();

            $('div#wait').hide();
          }
        },

        callBackMultiple: function(url) {
          window.KCFinder = null;
          $('#wait').show();
          //console.log(url);

          for (var i = 0; i < url.length; i++){
            var turl = url[i];     
            newurl = turl.substring(1, turl.length);

            if(multiple)
              scope.addPhoto.push(newurl);
            else
              scope.addPhoto = newurl;
          }

          scope.$apply();
          $('div#wait').hide();
         }
      };
      
      window.open('../ckeditor/filemanager/browse.php?type=images&langCode=pl',
                  (multiple)? 'kcfinder_multiple' : 'kcfinder_single', 
                  "status=0, directories=0, resizable=1, top=200, left=200, width="+ (screen.width - 400) +", height= "+ (screen.height - 400) +", scrollbars=0");
  };


  element.bind('click', ClickCallback);
    
  };

}]);