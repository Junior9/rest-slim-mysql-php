angular.module('main-user').controller('userController',function ($scope, $http, $location, $rootScope){

	$scope.users = {};
	$scope.user = {};
	
	$http.get('/usuarioapp/userapp/public/user/all')
	.success(function(users){
		$scope.users = users;
	})
	.catch(function(error){
		console.log(error);
	});
	
	$scope.save = function(){
		$http.post('/usuarios',$scope.user)
		.success(function(users){
			$scope.users = users;
			$location.path("/usuario");
		})
		.catch(function(error){
			console.log(error);
		});
	}
	
	$scope.delete = function(id){
		$http.delete('/usuarios',id)
		.success(function(users){
			$location.path("/usuario");
		})
		.catch(function(error){
			console.log(error);
		});
	}
	
	$scope.update = function(){
		$http.post('/usuarios',$scope.user)
		.success(function(user){
			$location.path("/usuario");
		})
		.catch(function(error){
			console.log(error);
		});
	}
	
});