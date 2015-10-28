var myApp = angular.module('caniride', [])
    .config(function($interpolateProvider) {
        $interpolateProvider.startSymbol('{[{');
        $interpolateProvider.endSymbol('}]}');
    });

function WeatherCtrl($rootScope, $http, $scope, $q) {

    $scope.activate = ' ddd';
    $scope.isActive = false;

    $scope.lat = 0;
    $scope.lng = 0;

    window.navigator.geolocation.getCurrentPosition(function(position) {

        $scope.lat = position.coords.latitude;
        $scope.lng = position.coords.longitude;

        $http.post('/api/weather', {
            lat: $scope.lat,
            lng: $scope.lng
        }).success(function(data) {
            $rootScope.weather = data;

            if (data.ride === 'good') {
                $rootScope.ride_text = 'all good, go for it!';
                $rootScope.page_class = 'ride-good';
            } 
            else if (data.ride === 'maybe') {
                $rootScope.ride_text = 'only if you feel brave!';
                $rootScope.page_class = 'ride-maybe';
            }
            else {
                $rootScope.ride_text = 'no way, give it a miss!';
                $rootScope.page_class = 'ride-bad';
            }

        });
    }, function(error) {
        $http.post('/api/weather', {}).success(function(data) {
            $rootScope.weather = data;

             if (data.ride === 'good') {
                $rootScope.ride_text = 'all good, go for it!';
                $rootScope.page_class = 'ride-good';
            } 
            else if (data.ride === 'maybe') {
                $rootScope.ride_text = 'only if you feel brave!';
                $rootScope.page_class = 'ride-maybe';
            }
            else {
                $rootScope.ride_text = 'no way, give it a miss!';
                $rootScope.page_class = 'ride-bad';
            }

        });
    }, {
        timeout: 5000
    });

    $scope.updateWeather = function() {
        $http.post('/api/weather', {
            lat: $scope.lat,
            lng: $scope.lng
        }).success(function(data) {
            $rootScope.weather = data;

             if (data.ride === 'good') {
                $rootScope.ride_text = 'all good, go for it!';
                $rootScope.page_class = 'ride-good';
            } 
            else if (data.ride === 'maybe') {
                $rootScope.ride_text = 'only if you feel brave!';
                $rootScope.page_class = 'ride-maybe';
            }
            else {
                $rootScope.ride_text = 'no way, give it a miss!';
                $rootScope.page_class = 'ride-bad';
            }

            changeWeather($rootScope.page_class)

        });
    }

    $scope.activeLocate = function() {
        $scope.isActive = !$scope.isActive;

        if ($scope.isActive == true) {
            $scope.activate = ' active';
        } else {
            $scope.locations = [];
            $scope.location = '';
            $scope.activate = '';
        }
    }

    $scope.change = function() {
        var canceller = $q.defer();

        if ($scope.location.length > 2) {
            $http.post('/api/location', {
                location: $scope.location,
                timeout: canceller.promise
            }).success(function(data) {
                $scope.locations = data;
            });
        }
    }

    $scope.teleport = function(lat, lng) {
        $scope.lat = lat;
        $scope.lng = lng;
        $scope.updateWeather();

        $scope.locations = [];
        $scope.activeLocate();
        $scope.location = '';
    }



}