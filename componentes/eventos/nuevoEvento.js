angular.module("nuevoEvento",[])

	.controller("nuevoEventoCtrl",function($scope,$http){

		$scope.participantes = [];
		$scope.lugares = [];

		$scope.datos = {
			nombre: '',
			descripcion: '',
			ruta_imagen: '',
			lugar: '',
			fecha: '',
			aforo: '',
			precioEntrada: '',
			//participantes: $scope.participantes
		}

		// Petición para cargar los participantes
		var peticion = {
			method : "POST",
	        url : "php/Get/getAll.php",
	        data: {
	        	tabla: 'participante'
	        },
	        headers: {
	        	'Content-Type': 'application/x-www-form-urlencoded'
	        }
		};

		$http(peticion).then(function mySuccess(response) {
	        $scope.participantes = response.data;
	    }, function myError(response) {
	        alert("No cargo bien el PHP");
	    });

		//Peticion para cargar los lugares
	    var peticion = {
			method : "POST",
	        url : "php/Get/getAll.php",
	        data: {
	        	tabla: 'lugar'
	        },
	        headers: {
	        	'Content-Type': 'application/x-www-form-urlencoded'
	        }
		};

		$http(peticion).then(function mySuccess(response) {
	        $scope.lugares = response.data;
	    }, function myError(response) {
	        alert("No cargo bien el PHP");
	    });


		$scope.nuevoEvento = function(){

			peticion = {
				method : "POST",
			    url : "php/Inserciones/nuevoEvento.php",
			    data: $scope.datos,
			    headers: {
			        'Content-Type': 'application/x-www-form-urlencoded'
			    }
			};

			$http(peticion).then(function mySuccess(response) {
			    alert("Nuevo evento creado!!");
			}, function myError(response) {
			    alert("No cargo bien el PHP");
			});
		}

	});