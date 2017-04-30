var mainCtrl = angular.module('mainCtrl',  []);

/*----------------------------item management dashboard -----------------------------*/
mainCtrl.controller('loginCtrl',function($scope, $http)
	{
		$scope.login = function()
		{
			var data = 
              $.param({
                    email: $scope.email,
                    pass: $scope.password
              });

      $http({
        method: 'POST',
        url: 'login',
        data: data,
        headers:{'Content-Type': 'application/x-www-form-urlencoded'}
      }).then(function (data, status, headers, config){
         // location.reload();
      });

		};
        /*
         $scope.logout =function()
        {

            $http.get('/os/api/logout')
            .success(function (response) {
               window.location.reload();
            })
            .error(function (error, status) {
                console.log(status);
            });
        };
        */

	});
