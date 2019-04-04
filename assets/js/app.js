var app = angular.module('app', ['ngRoute','ngMeta','ui.bootstrap']);

app.config(['$locationProvider', '$routeProvider','ngMetaProvider', function ($locationProvider, $routeProvider,ngMetaProvider) {
$routeProvider.

when('/contact', {
templateUrl: './themes/default/contact.html',
data: {
      meta: {
        'title': 'Contact Us',
        'description': 'Contact us'
      }
    }
}).
when('/home', {
templateUrl: './themes/default/home.html',
 data: {
      meta: {
        'title': 'BookonBoard - Start Your Jorney Today',
        'description': 'BookonBoard is the best source for your online travel booking business. we offer last minute travel services such as flights hotels rooms tours and cars rental or transfer '
      }
    }
}).

when('/hotels', {
templateUrl: './themes/default/hotels.html',
 data: {
      meta: {
        'title': 'Booknow - Hotels',
        'description': 'Find last minute and cheap hotels'
      }
    }
}).

when('/flights', {
templateUrl: './themes/default/flights/list.html',
 data: {
      meta: {
        'title': 'Flights Results',
        'description': 'Find last minute and cheap hotels'
      }
    }
}).

when('/flights-booking', {
templateUrl: './themes/default/flights/book.html',
 data: {
      meta: {
        'title': 'Flights Booking',
        'description': 'Book your flights at best rate'
      }
    }
}).

otherwise({
redirectTo: '/home'
});

$locationProvider.html5Mode(true);
}])

.run(['ngMeta', function(ngMeta) {
    ngMeta.init();
}])

.directive('headaccount', function() {
     return {
      restrict: 'E',
     templateUrl: './themes/default/directives/headaccount.html',
    };
});

app.controller('FlightsList', ['$http','$scope','$location',function ($http,$scope,$location) {

$http({
method: 'GET',
url: 'https://bookingengine.co/api/flight/search',
params: $location.search(),
headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
}).then(
function(res) {

$scope.items = res.data.data;
console.log('succes !',  res.data.data[0]);
},

function(err) {
console.log('error...', err);
}
);

$scope.limit= 10;

// loadMore function
$scope.loadMore = function() {
$scope.limit =   $scope.limit + 5;
}
}]);

app.controller('Home', ['$http','$scope','$location',function ($http,$scope,$location) {

$scope.payload = {};
$scope.payload.flyFrom = "DXB";
$scope.payload.to = "LHE";
$scope.payload.dateFrom = "01/04/2019";
$scope.payload.dateTo = "04/04/2019";
$scope.payload.adults = "1";
$scope.states = [];

$scope.setflyFrom = function(site) {
    $scope.payload.flyFrom = site.code;
};

$scope.setto = function(site) {
    $scope.payload.to = site.code;
};

$scope.getStates = function(field) {
    $scope.states = [];
    var token = $scope.payload.to;
    if (field == 'origin') {
        token = $scope.payload.flyFrom;
    }

    if (token.length > 2) {
        $http.get('https://bookingengine.co/api/global/airports?token=123&code='+token).then(
            function(res) {
                console.log(res.data.data);
                $scope.states = res.data.data;
            },
            function(err) {
                console.log('error...', err);
            }
        );
    }
}
   /*$http({
method: 'GET',
url: 'assets/js/airports.json'
}).then(
function(res) {

$scope.states = res.data;
console.log('succes !',  res.data);
},

function(err) {
console.log('error...', err);
}
);*/




$scope.search= function(){

$scope.payload.children=0;
$scope.payload.infants=0;
$scope.payload.curr="USD";
$scope.payload.vendor="5";
$scope.payload.ota_id="8ed24880-e6ad-11e8-a4c9-15f8a84bf814";
$scope.payload.flight_type="oneway";

console.log($scope.payload);

$location.path('/flights').search($scope.payload);

}

}]);