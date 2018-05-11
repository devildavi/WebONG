angular.module("tiendas",[])

	.controller("tiendasCtrl",function($scope,$http){

		$scope.tiendas = [];

		//Petición para cargar tiendas
		$http({
	        method : "POST",
	        url : "php/Get/getAll.php",
	        data: {
	        	tabla: 'tienda'
	        }
	    }).then(function mySuccess(response) {
	        $scope.tiendas = response.data; 
	    }, function myError(response) {
	        alert("No cargo bien el PHP");
	    });
    			
	});