angular
	.module("login",[])
	.controller("loginCtrl",function($scope,$http,usuarios){

		$scope.usuario = {
			nombre: '',
			password: ''
		}

		$scope.login = function(){
			
			//var pass = md5.createHash($scope.usuario.password);
			//$scope.usuario.password = '';

			var datos = {
				usuario: $scope.usuario.nombre,
				pass: $scope.usuario.password
			}

			var peticion = {
				method: 'POST',
				url: 'php/Get/usuario.php',
				data: datos,
				headers: {
			        'Content-Type': 'application/x-www-form-urlencoded'
			    }
			};

			$http(peticion).then(function mySuccess(response) {
		        if(response.data.resultado == 'OK'){
						usuarios.setUsuario(response.data.datos);
						$scope.usuario = usuarios.getUsuario();
						$scope.usuario.logueado = true;
						//$sessionStorage.usuario = $scope.usuario;
						alert("Usuario encontrado con nombre: "+response.data.datos[0].nombre);
					}else{
						alert("Usuario no encontrado");
					}
		    }, function myError(response) {
		        alert("No cargo bien el PHP");
		    });
		}

	});