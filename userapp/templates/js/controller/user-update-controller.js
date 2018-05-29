angular.module('main-user').controller('userUpdateController',function ($scope, $http, $location, $rootScope){

	$scope.user = {};
	$scope.id = sessionStorage.getItem('id');


	$http.get('/usuarioapp/userapp/public/user/'+$scope.id)
	.success(function(user){
		$scope.user = user;
	})
	.catch(function(error){
		console.log(error);
	});

	$scope.update = function(){
		$http.put('/usuarioapp/userapp/public/user/update/'+$scope.id ,$scope.user)
		.success(function(user){
			$location.path("/home");
		})
		.catch(function(error){
			console.log(error);
		});
	}
});