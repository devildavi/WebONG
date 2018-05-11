angular.module("nuevoProducto",[])

	.controller("nuevoProductoCtrl",function($scope,$http,$routeParams){

		$scope.nome = function(){
			alert($scope.file);
		}

		$scope.datos = {
				nombre: "",
				descripcion: "",
				precio: "",
				categoria: "",
				fechafin: "",
				imagen: "",
				idtienda: "",
				stock: "",
				estado: ""
			}

		$scope.daralta = function(){

			var peticion = {
				method : "POST",
			    url : "php/Inserciones/nuevoProducto.php",
			    data: $scope.datos,
			    headers: {
			        'Content-Type': 'application/x-www-form-urlencoded'
			    }
			};

			$http(peticion).then(function mySuccess(response) {
			    alert("Nuevo producto creado!!");
			}, function myError(response) {
			    alert("No cargo bien el PHP");
			});
		
		}

		$scope.tiendas = [];
		$scope.estados = [];
		$scope.categorias = [];

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

	    //Petición para cargar los estados de los productos
	    $http({
	        method : "POST",
	        url : "php/Get/getAll.php",
	        data: {
	        	tabla: 'estado'
	        }
	    }).then(function mySuccess(response) {
	        $scope.estados = response.data; 
	    }, function myError(response) {
	        alert("No cargo bien el PHP de estados");
	    });

	    //Petición para cargar categorías
		$http({
	        method : "POST",
	        url : "php/Get/getAll.php",
	        data: {
	        	tabla: 'categoria'
	        }
	    }).then(function mySuccess(response) {
	        $scope.categorias = response.data; 
	    }, function myError(response) {
	        alert("No cargo bien el PHP");
	    });
	    			
	});