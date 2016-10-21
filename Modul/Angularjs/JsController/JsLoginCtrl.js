'use strict';

pebs.controller('loginController', function ($scope, $http, $location) {
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

            if (d[0].err === 'false') {
                console.log('Login Berhasil');
                document.cookie = 'token=true=' + d[1].token_kar;
                //$location.path('/adminhome');
            } else {
                console.log(data);
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