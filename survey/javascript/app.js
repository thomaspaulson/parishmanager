'use strict';

angular.module('surveyApp', ['ngRoute','familyModule','memberModule']);

angular.module('surveyApp').config(["$routeProvider", "$locationProvider", "$httpProvider", 
	function($routeProvider, $locationProvider, $httpProvider){
		$routeProvider.when('/family',{
			controller:'FamilyController',
			templateUrl:'/survey/javascript/modules/family/family.html'
		}).when('/family/new',{
			controller: 'FamilyController',
			templateUrl: '/survey/javascript/modules/family/family-new.html'		
		}).when('/family/edit',{
			controller: 'FamilyController',
			templateUrl: '/survey/javascript/modules/family/family-edit.html'
		}).when('/members',{
			controller: 'MemberController',
			templateUrl: '/survey/javascript/modules/member/member.html'
		});
	
	$routeProvider.otherwise({redirectTo:'/family'});
	// Set the `X-Requested-With` header so we can use SilverStripe's request->isAjax()
	$httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
	
}]);


