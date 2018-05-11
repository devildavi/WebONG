angular.module("eventos",[])

	.controller("eventosCtrl",function($scope,$http){

		$scope.eventos = [];

		$http({
	        method : "POST",
	        url : "php/Get/eventos.php"
	    }).then(function mySuccess(response) {
	        $scope.eventos = response.data; 
	    }, function myError(response) {
	        alert("No cargo bien el PHP");
	    });

	});