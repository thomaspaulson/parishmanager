angular.module('surveyApp.family.controllers',[]);

angular.module('surveyApp.family.controllers').controller('FamilyController',
["$scope", "familyFactory", function($scope, familyFactory) {
	
  $scope.greeting = 'Hello Family';    
  $scope.customers;
  //$promise = familyFactory.getFamilyList();
  
  familyFactory.getFamilyList().then(function (response) {
	  //console.log(response);
	  $scope.families = response.data;
  });     
    
  
}]);


