'use strict';

var controllersSite = angular.module( 'controllersSite' , [] );


controllersSite.controller( 'siteProducts' ,  [ '$scope' , '$http' , '$location' , function( $scope , $http, $location ){
	
	$http.get( 'api/site/products/get' ).
	success( function( data ){
		$scope.products = data;
	}).error( function(){
		console.log( 'Błąd połączenia z API' );
	});

	$scope.formSubmit = function ( liczdate ) {
			
			console.log(liczdate.wyniki+" "+liczdate.daty1+" "+liczdate.daty2);
			
				$http.post( 'api/site/products/liczdatywszys/' , {
					wyniki : liczdate.wyniki,
					daty1 : liczdate.daty1,
					daty2 : liczdate.daty2
				}).success( function( data ){

					$scope.submit = true;
					$scope.liczdatywszys=data;
				}).error( function(){
					console.log( 'Błąd połączenia z API' );
				});
			
	};
	
}]);

controllersSite.controller( 'sitesqlite' , [ '$scope' , '$http', '$location'  , function( $scope , $http, $location ){
	
	$http.get( 'api/site/sqlite/get' ).
	success( function( data ){
		$scope.sqlite = data;
	}).error( function(){
		console.log( 'Błąd połączenia z API' );
	});
	
	$scope.formwszystkiewyn = function ( liczwszywyniki ) {
		
		console.log(liczwszywyniki.maszyna+" "+liczwszywyniki.dataod+" "+liczwszywyniki.datado+" "+liczwszywyniki.procod+" "+liczwszywyniki.procdo+" "+liczwszywyniki.procestype+" "+liczwszywyniki.procesStatus+" "+liczwszywyniki.errorId);
		
			$http.post( 'api/site/sqlite/szukajsqlite/' , {
					maszyna : liczwszywyniki.maszyna,
					dataod : liczwszywyniki.dataod,
					datado : liczwszywyniki.datado,
					procod : liczwszywyniki.procod,
					procdo : liczwszywyniki.procdo,
					procestype : liczwszywyniki.procestype,
					procesStatus : liczwszywyniki.procesStatus,
					errorId : liczwszywyniki.errorId
				}).success( function( data ){

					$scope.submit = true;
					$scope.szukajsqlite=data;
				}).error( function(){
					console.log( 'Błąd połączenia z API' );
				});
	}

}]);
