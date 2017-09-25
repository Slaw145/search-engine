'use strict';

var app = angular.module( 'app' , [ 'ngRoute' , 'controllersSite' ] );

app.config( [ '$routeProvider' , '$httpProvider' , function( $routeProvider , $httpProvider ) {
	
	
	$routeProvider.when( '/products' , {
		controller : 'siteProducts',
		templateUrl : 'partials/site/products.html'
	});
	
	$routeProvider.when( '/sqlite' , {
		controller : 'sitesqlite',
		templateUrl : 'partials/site/sqlite.html'
	});
	
	$routeProvider.when( '/baza' , {
		controller : 'siteProducts',
		templateUrl : 'partials/site/calabaza.html'
	});
	
	$routeProvider.when( '/bazasqlite' , {
		controller : 'sitesqlite',
		templateUrl : 'partials/site/calabazasqlite.html'
	});

	$routeProvider.otherwise({
		redirectTo: '/products'
	});

}]);


