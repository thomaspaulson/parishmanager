angular.module('familyModule', ['surveyApp.family.controllers']);

angular.module('familyModule').factory('familyFactory',["$http", function($http){
	return {
		getFamilyList: function(){
			 return $http.get('/family/getlist');			
		},
		echo: function(message){
			alert(message);
		}
	}
}]);
