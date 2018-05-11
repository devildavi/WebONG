/*Modulo AlmacenApp*/

//Crear módulo o aplicación --> Modelo
angular
	.module("almacenApp",['productos','ngRoute','fichaproducto','registro',
		'nuevoProducto','nuevaTienda','login','tiendas','eventos','nuevoEvento'])

	.config(function($routeProvider,$locationProvider,vistaext){
		$locationProvider.hashPrefix('');
		$routeProvider
			.when('/',{
				templateUrl: "componentes/inicio/inicio."+vistaext,
				controller: "mainCtrl"
			})
			.when('/productos',{
				templateUrl: "componentes/productos/productos."+vistaext,
				controller: "productosCtrl"
			})		
			.when('/producto/:itemid',{
				templateUrl: "componentes/productos/fichaproducto."+vistaext,
				controller: "fichaProductoCtrl"
			})
			.when('/nuevoProducto',{
				templateUrl: "componentes/productos/nuevoProducto."+vistaext,
				controller: "nuevoProductoCtrl"
			})
			.when('/nuevaTienda',{
				templateUrl: "componentes/tiendas/nuevaTienda."+vistaext,
				controller: "nuevaTiendaCtrl"
			})
			.when('/eventos',{
				templateUrl: "componentes/eventos/eventos."+vistaext,
				controller: "eventosCtrl"
			})
			.when('/nuevoEvento',{
				templateUrl: "componentes/eventos/nuevoEvento."+vistaext,
				controller: "nuevoEventoCtrl"
			})
			.when('/contacto',{
				templateUrl: "componentes/contacto/contacto."+vistaext,
				//controller: "contactoCtrl"
			})
			.when('/login',{
				templateUrl: "componentes/login/login."+vistaext,
				controller: "loginCtrl"
			})
			.when('/registro',{
				templateUrl: "componentes/registro/registro."+vistaext,
				controller: "registroCtrl"
			})
			.when('/quienes',{
				templateUrl: "componentes/quienes/quienes."+vistaext,
				//controller: "registroCtrl"
			})
			.when('/tiendas',{
				templateUrl: "componentes/tiendas/tiendas."+vistaext,
				controller: "tiendasCtrl"
			})
			.otherwise({
				redirectTo: '/'
			})
	})

	.constant("vistaext","view.html")

	.controller("mainCtrl",function($scope){

	})

	.directive("cabecera",function (){

		return {
			templateUrl: "componentes/cabecera/cabecera.view.html"
		};
	})

	.directive("pie",function (){

		return {
			templateUrl: "componentes/footer/footer.view.html"
		};
	});

	//.component("listaArticulos",{
	//	templateUrl: "vistas/articulos.view.html",
	//	controller: "artCtrl"
	//})
	