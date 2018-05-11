
angular.module("fichaproducto",[])

	.controller("fichaProductoCtrl",function($scope,$http,$routeParams,$route){

		$scope.itemid = parseInt($routeParams.itemid)+1;
		$scope.precio_total = 0;

		$scope.producto = {
			id:$scope.itemid
		};

		$scope.modal = {};
		$scope.reserva = {};

		var datos = {
			id:$scope.itemid
		}

		var peticion = {
			method : "POST",
	        url : "php/Get/fichaproducto.php",
	        data: datos,
	        headers: {
	        	'Content-Type': 'application/x-www-form-urlencoded'
	        }
		};

		$http(peticion).then(function mySuccess(response) {
	        $scope.producto = response.data;
	    }, function myError(response) {
	        alert("No cargo bien el PHP");
	    });

	    $scope.editarProducto = function (){

			$("#myModal").modal({
				backdrop: false
			});

	    }

	    $scope.modificar = function (){

			peticion = {
				method : "POST",
		        url : "php/Update/updateProducto.php",
		        data: $scope.producto,
		        headers: {
		        	'Content-Type': 'application/x-www-form-urlencoded'
		        }
			};

			$http(peticion).then(function mySuccess(response) {
		        $scope.resultado = response.data;
		    }, function myError(response) {
		        alert("No cargo bien el PHP");
		    });

		    $route.reload();
	    }

		$scope.reserva = {
		    id_usuario: 1,
		    id_prod: $scope.itemid,
		    id_tienda: '',
		    cantidad: '',
		    precio_total: $scope.precio_total,
		    fecha: new Date()
	    };

	    $scope.reservar = function (){

	    	$scope.precio_total = $scope.cantidad * $scope.producto.precio;

	    	$scope.reserva = {
		    	id_usuario: 1,
		    	id_prod: $scope.itemid,
		    	id_tienda: $scope.idtienda,
		    	cantidad: $scope.cantidad,
		    	precio_total: $scope.precio_total,
		    	fecha: new Date()
	    	};

	    	peticion = {
				method : "POST",
		        url : "php/Update/updateProducto.php",
		        data: $scope.reserva,
		        headers: {
		        	'Content-Type': 'application/x-www-form-urlencoded'
		        }
			};

			$http(peticion).then(function mySuccess(response) {
		        $scope.resultado = response.data;
		    }, function myError(response) {
		        alert("No cargo bien el PHP");
		    });
	    }
	});

