
app.directive('modalResize', ['$timeout', function($timeout){

  return function (scope, element, attr) {
    $timeout(function () {

      var heightWindow  = $(window).height();
      var height        = heightWindow - 190;

      console.log('height: ' + heightWindow);

      element.css({
        height: height
      });

    });
  };
}]);