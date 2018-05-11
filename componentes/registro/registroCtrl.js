angular.module("registro",[])

	.controller("registroCtrl",function($scope,$http,$routeParams){

		$scope.mod = {
					'titulo': "Error con contraseñas",
					'mensaje': "Las contraseñas no coinciden"
				}

		$scope.registrarse = function(){

			$scope.nombreCompleto = $scope.nombre.split(" ");

			if($scope.password==$scope.password2){

				var datos = {
					NIF: $scope.nif,
					nombre: $scope.nombreCompleto[0],
					apellido1: $scope.nombreCompleto[1],
					apellido2: $scope.nombreCompleto[2],
					email: $scope.email,
					telefono: $scope.telefono,
					direccion: $scope.direccion,
					localidad: $scope.localidad,
					provincia: $scope.provincia,
					password: $scope.password,
					tipo: 3,
					fecha_sesion: '2017/10/11'
				}

				var peticion = {
					method : "POST",
			        url : "php/Inserciones/nuevoUsuario.php",
			        data: datos,
			        headers: {
			        	'Content-Type': 'application/x-www-form-urlencoded'
			        }
				};

				$http(peticion).then(function mySuccess(response) {
			        alert("Nuevo usuario creado!!");

			    }, function myError(response) {
			        alert("No cargo bien el PHP");
			    });

			}else{
				
				$("#modalError").modal({
					backdrop: false
				});
			}
		}
		
	});