var pebs = angular.module("pebApp", ['ngRoute', 'ngResource']);

pebs.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider.

            when('/', {
            resolve: {
                "check": function ($location) {

                    var kue = document.cookie;
                    var kueIndex = kue.split(';')[0];
                    var kueExplode = kueIndex.split('=');
                    var kueFinal = [{"session": kueExplode[0], "status": kueExplode[1], "token": kueExplode[2]}];
                    var kueStatus = kueFinal[0]['status'];

                    if(kueStatus == 'true') {
                        $location.path('/adminhome');
                    }

                }
            },
                templateUrl: 'View/Landing.html',
                controller: 'loginController',
                title: 'Selamat Datang'
            }).

            // Karyawan Section

            when('/karyawan', {
                templateUrl: 'View/Karyawan/Karyawan.html',
                title: 'Profil Karyawan'
            }).

            when('/reqcuti', {
                templateUrl: 'View/Karyawan/ReqCuti.html',
                controller: 'cutiController',
                title: 'Permohonan Cuti'
            }).

            when('/hiscuti', {
                templateUrl: 'View/Karyawan/HisCuti.html',
                title: 'Data Cuti'
            }).

            when('/slip', {
                templateUrl: 'View/Karyawan/Slip.html',
                title: 'Slip Gaji'
            }).

            when('/reqpass', {
                templateUrl: 'View/Karyawan/ReqPass.html',
                title: 'Pergantian Password Akun'
            }).

            // HRD Section

            when('/hrd', {
                templateUrl: 'View/Hrd.html',
                title: 'Human Resource'
            }).

            // Redirect Section

            when('', {
                redirectTo: '/'
            }).

            when('/404', {
                templateUrl: 'View/404.html',
                title: 'Halaman Tidak Ditemukan Error 404'
            }).

            otherwise({
                redirectTo: '/404'
            });
    }]);

pebs.run(['$location', '$rootScope',
    function ($location, $rootScope) {
        $rootScope.$on('$routeChangeSuccess', function (event, current) {
            if (current.hasOwnProperty('$$route')) {
                $rootScope.title = current.$$route.title;
            }
        });
    }]);

pebs.controller('NavClass', function ($scope, $location) {
    $scope.isActive = function (viewLocation) {
        return viewLocation === $location.path();
    };
});