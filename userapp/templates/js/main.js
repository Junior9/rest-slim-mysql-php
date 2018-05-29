angular.module('main-user', ['ngRoute','ngResource'])
.config(function($routeProvider,$locationProvider) {
	
	 $routeProvider.when('/home', {
         templateUrl: '/usuarioapp/userapp/templates/partials/usuario.html',
         controller: 'userController'
     });	 

	 //$routeProvider.otherwise({redirectTo:'/home'});
	
});