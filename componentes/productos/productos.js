angular.module("productos",[])

	.controller("productosCtrl",function($scope,$http){

	$scope.productos = [];
	$scope.categorias = {};

	$scope.activeMenu = 'Todos';

		//Petición para cargar los artículos
		$http({
	        method : "GET",
	        url : "php/Get/productos.php"
	    }).then(function mySuccess(response) {
	        $scope.productos = response.data; 
	    }, function myError(response) {
	        alert("No cargo bien el PHP");
	    });

	    $scope.cambiarCategoria = function (cat,menu){

	    	$scope.categorias.categoria = cat;
	    	$scope.activeMenu = menu;
	    }

	})
    
//Filtro que formatea la fecha de alta
	.filter('vFecha',function() {
		return function vFecha(texto){
			return(texto) ? texto.fv() : "";
		};
	})

//Filtro que situa el € detrás del número
	.filter('currency', function() {
		return function currency(texto,moneda){
			return parseFloat(texto).formato(moneda);
		};
	});