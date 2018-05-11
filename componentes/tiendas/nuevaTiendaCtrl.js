angular.module("nuevaTienda",[])

	.controller("nuevaTiendaCtrl",function($scope,$http,$routeParams){

		$scope.daralta = function(){

			var datos = {
				nombre: $scope.nombre,
				direccion: $scope.direccion,
				ciudad: $scope.ciudad,
				codigopostal: $scope.codigopostal,
				telefono: $scope.telefono,
				email: $scope.email,
				fax: $scope.fax
			}

			var peticion = {
				method : "POST",
			    url : "php/Inserciones/nuevaTienda.php",
			    data: datos,
			    headers: {
			        'Content-Type': 'application/x-www-form-urlencoded'
			    }
			};

			$http(peticion).then(function mySuccess(response) {
			    alert("Nueva tienda creada!!");
			}, function myError(response) {
			    alert(response.status+" "+response.statusText);
			});
		
		}
	    			
	});