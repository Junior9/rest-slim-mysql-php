angular.module('main-user', ['ngRoute','ngResource'])
.config(function($routeProvider,$locationProvider) {
	
	 $routeProvider.when('/home', {
         templateUrl: '/usuarioapp/userapp/templates/partials/user.html',
         controller: 'userController'
     });	 

     $routeProvider.when('/user/add', {
         templateUrl: '/usuarioapp/userapp/templates/partials/new-user.html',
         controller: 'userController'
     });	

     $routeProvider.when('/user/update', {
         templateUrl: '/usuarioapp/userapp/templates/partials/update-user.html',
         controller: 'userUpdateController'
     });	

	 //$routeProvider.otherwise({redirectTo:'/home'});
	
});