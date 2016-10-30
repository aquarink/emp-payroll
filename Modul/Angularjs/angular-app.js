var pebs = angular.module("pebApp", ['ngRoute', 'ngResource']);

pebs.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider.

            when('/', {
                resolve: {
                    "check": function ($location) {
                        if (localStorage.getItem('token') == null && localStorage.getItem('stat') == null){
                            console.log('token kosong dan redirect login');
                        } else {
                            if(localStorage.getItem('stat') == '4') {
                                $location.path('/hrd');
                            } else {
                                $location.path('/karyawan');
                            }

                        }

                    }
                },
                templateUrl: 'View/Landing.html',
                controller: 'karyawanController',
                title: 'Selamat Datang'
            }).

            // Karyawan Section

            when('/karyawan', {
                resolve: {
                    "check": function ($location) {
                        if (localStorage.getItem('token') == null && localStorage.getItem('stat') == null){
                            $location.path('/');
                        } else {
                            if(localStorage.getItem('stat') == '4') {
                                $location.path('/hrd');
                            }

                        }

                    }
                },
                templateUrl: 'View/Karyawan/Karyawan.html',
                controller: 'karyawanController',
                title: 'Profil Karyawan'
            }).

            when('/reqcuti', {
                resolve: {
                    "check": function ($location) {
                        if (localStorage.getItem('token') == null && localStorage.getItem('stat') == null){
                            $location.path('/');
                        } else {
                            if(localStorage.getItem('stat') == '4') {
                                $location.path('/hrd');
                            }

                        }

                    }
                },
                templateUrl: 'View/Karyawan/ReqCuti.html',
                controller: 'cutiController',
                title: 'Permohonan Cuti'
            }).

            when('/hiscuti', {
                resolve: {
                    "check": function ($location) {
                        if (localStorage.getItem('token') == null && localStorage.getItem('stat') == null){
                            $location.path('/');
                        } else {
                            if(localStorage.getItem('stat') == '4') {
                                $location.path('/hrd');
                            }

                        }

                    }
                },
                templateUrl: 'View/Karyawan/HisCuti.html',
                title: 'Data Cuti'
            }).

            when('/slip', {
                resolve: {
                    "check": function ($location) {
                        if (localStorage.getItem('token') == null && localStorage.getItem('stat') == null){
                            $location.path('/');
                        } else {
                            if(localStorage.getItem('stat') == '4') {
                                $location.path('/hrd');
                            }

                        }

                    }
                },
                templateUrl: 'View/Karyawan/Slip.html',
                title: 'Slip Gaji'
            }).

            when('/reqpass', {
                resolve: {
                    "check": function ($location) {
                        if (localStorage.getItem('token') == null && localStorage.getItem('stat') == null){
                            $location.path('/');
                        } else {
                            if(localStorage.getItem('stat') == '4') {
                                $location.path('/hrd');
                            }

                        }

                    }
                },
                templateUrl: 'View/Karyawan/ReqPass.html',
                title: 'Pergantian Password Akun'
            }).

            // HRD Section

            when('/hrd', {
                resolve: {
                    "check": function ($location) {
                        if (localStorage.getItem('token') == null && localStorage.getItem('stat') == null){
                            $location.path('/');
                        } else {
                            if(localStorage.getItem('stat') == '1') {
                                $location.path('/karyawan');
                            }

                        }

                    }
                },
                templateUrl: 'View/Hrd/Hrd.html',
                title: 'Pengajuan Cuti'
            }).

            when('/jadcutiyes', {
                resolve: {
                    "check": function ($location) {
                        if (localStorage.getItem('token') == null && localStorage.getItem('stat') == null){
                            console.log('token kosong dan redirect login');
                        } else {
                            if(localStorage.getItem('stat') == '1') {
                                $location.path('/karyawan');
                            }

                        }

                    }
                },
                templateUrl: 'View/Hrd/JadwalCutiYes.html',
                title: 'Jadwal Cuti Diterima'
            }).

            when('/jadcutino', {
                resolve: {
                    "check": function ($location) {
                        if (localStorage.getItem('token') == null && localStorage.getItem('stat') == null){
                            $location.path('/');
                        } else {
                            if(localStorage.getItem('stat') == '1') {
                                $location.path('/karyawan');
                            }

                        }

                    }
                },
                templateUrl: 'View/Hrd/JadwalCutiNo.html',
                title: 'Jadwal Cuti Ditolak'
            }).

            when('/datakar', {
                resolve: {
                    "check": function ($location) {
                        if (localStorage.getItem('token') == null && localStorage.getItem('stat') == null){
                            $location.path('/');
                        } else {
                            if(localStorage.getItem('stat') == '1') {
                                $location.path('/karyawan');
                            }

                        }

                    }
                },
                templateUrl: 'View/Hrd/DataKaryawan.html',
                title: 'Data Karyawan'
            }).

            when('/hrreqpass', {
                resolve: {
                    "check": function ($location) {
                        if (localStorage.getItem('token') == null && localStorage.getItem('stat') == null){
                            $location.path('/');
                        } else {
                            if(localStorage.getItem('stat') == '1') {
                                $location.path('/karyawan');
                            }

                        }

                    }
                },
                templateUrl: 'View/Hrd/HeReqPass.html',
                title: 'Ubah Password HRD'
            }).

            when('/tmbkar', {
                resolve: {
                    "check": function ($location) {
                        if (localStorage.getItem('token') == null && localStorage.getItem('stat') == null){
                            $location.path('/');
                        } else {
                            if(localStorage.getItem('stat') == '1') {
                                $location.path('/karyawan');
                            }

                        }

                    }
                },
                templateUrl: 'View/Hrd/TambahKaryawan.html',
                title: 'Tambah Karyawan'
            }).

            when('/slipgaji', {
                resolve: {
                    "check": function ($location) {
                        if (localStorage.getItem('token') == null && localStorage.getItem('stat') == null){
                            $location.path('/');
                        } else {
                            if(localStorage.getItem('stat') == '1') {
                                $location.path('/karyawan');
                            }

                        }

                    }
                },
                templateUrl: 'View/Hrd/PostSlip.html',
                title: 'Terbitkan Slip Gaji'
            }).

            when('/editkar/:idkaryawan', {
                resolve: {
                    "check": function ($location) {
                        if (localStorage.getItem('token') == null && localStorage.getItem('stat') == null){
                            $location.path('/');
                        } else {
                            if(localStorage.getItem('stat') == '1') {
                                $location.path('/karyawan');
                            }

                        }

                    }
                },
                templateUrl: 'View/Hrd/EditKaryawan.html',
                title: 'Edit Data Karyawan'
            }).

            when('/404', {
                templateUrl: 'View/404.html',
                title: 'Halaman Tidak Ditemukan Error 404'
            }).

            when('/out', {
                resolve: {
                    "check": function () {
                        localStorage.clear();
                    }
                },
                redirectTo: '/'
            }).

            otherwise({
                redirectTo: '/'
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