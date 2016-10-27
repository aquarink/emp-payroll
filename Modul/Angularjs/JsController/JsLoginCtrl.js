'use strict';

pebs.controller('karyawanController', function ($scope, $http, $location) {

    $scope.ambilUser = function () {
        if (selfUrl == '::1') {
            selfUrl = 'localhost';

        }
        $http.post('http://' + selfUrl + '/PsProjectEmpPayRoll/system.php?p=karyawan&f=getdatakaryawan', {
            'token': localStorage.getItem('token')
        }).
            success(function (data) {
                $scope.datakaryawan = data;
            }).
            error(function (data, status, header, config) {
                console.log('D :' + data, 'S :' + status, 'H :' + header, 'C :' + config);
                //$location.path('/admin');
                $scope.apply();
            })
    }

    $scope.masukUser = function () {
        if (selfUrl == '::1') {
            selfUrl = 'localhost';
        }
        $http.post('http://' + selfUrl + '/PsProjectEmpPayRoll/system.php?p=karyawan&f=login', {
            'nipTxt': $scope.nipTxt,
            'passTxt': $scope.passTxt
        }).
            success(function (data) {
                var d = $scope.datanya = data;

                console.log(d);

                if (d.err === 'false') {
                    console.log('Login Berhasil');

                    if (typeof(Storage) !== "undefined") {
                        localStorage.setItem("token", d.token);
                        document.cookie = 'token=' + d.token;
                        $location.path('/karyawan');
                    } else {
                        console.log('Sorry! No Web Storage support..');
                    }
                } else {
                    $scope.pesan = 'Nip atau Password Salah!';
                    $scope.passTxt = '';
                    document.getElementById("nip").focus();
                }
            }).
            error(function (data, status, header, config) {
                console.log('D :' + data, 'S :' + status, 'H :' + header, 'C :' + config);
                $location.path('/admin');
                $scope.apply();
            })
    }
});