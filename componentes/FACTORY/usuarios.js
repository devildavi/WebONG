angular
	.module('almacenApp')
	.factory('usuarios',usuarioServicio);

	function usuarioServicio(){

		var esqueleto = {
			id : '',
			usuario : '',
			rol : '',
			nombre : '',
			password : '',
			logueado: false,
			permisos: {
				articulos : false,
				contacto : false,
				perfil : false
			}
		};

		var servicio = {};

		var usuario = esqueleto;

		var getUsuario = function (){
			return usuario;
		}

		var setUsuario = function (user){
			usuario = user;
		}

		var clearUsuario = function(){
			usuario = esqueleto;
			return usuario;
		}

		servicio.getUsuario = getUsuario;
		servicio.setUsuario = setUsuario;
		servicio.clearUsuario = clearUsuario;
		return servicio;
	}