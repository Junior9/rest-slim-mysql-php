angular.module('main-user').controller('userController',function ($scope, $http, $location, $rootScope){

	$scope.users = {};
	$scope.user = {};
	$scope.id = sessionStorage.getItem('id');



	$http.get('/usuarioapp/userapp/public/user/all')
	.success(function(users){
		$scope.users = users;
	})
	.catch(function(error){
		console.log(error);
	});
	
	$scope.save = function(){
		$http.post('/usuarioapp/userapp/public/user/add',$scope.user)
		.success(function(data){
			$location.path("/home");
		})
		.catch(function(error){
			console.log(error);
		});
	}
	
	$scope.delete = function(id){
		$http.delete('/usuarioapp/userapp/public/user/delete/'+id)
		.success(function(data){
			$location.path("/home");
		})
		.catch(function(error){
			console.log(error);
		});
	}
	
	$scope.update = function(id){
		sessionStorage.setItem('id',id);
		$location.path("/user/update");
	}

	$scope.update1 = function(){
		$http.post('/usuarioapp/userapp/public/usuarios',$scope.user)
		.success(function(user){
			$location.path("/home");
		})
		.catch(function(error){
			console.log(error);
		});
	}
});