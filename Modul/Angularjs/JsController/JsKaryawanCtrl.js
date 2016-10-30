'use strict';

pebs.controller('karyawanController', function ($scope, $http, $routeParams, $location) {

    $scope.tanggal = [
        {val:'1'}, {val:'2'}, {val:'3'}, {val:'4'}, {val:'5'}, {val:'6'}, {val:'7'}, {val:'8'}, {val:'9'}, {val:'10'},
        {val:'11'}, {val:'12'}, {val:'13'}, {val:'14'}, {val:'15'}, {val:'16'}, {val:'17'}, {val:'18'}, {val:'19'}, {val:'20'},
        {val:'21'}, {val:'22'}, {val:'23'}, {val:'24'}, {val:'25'}, {val:'26'}, {val:'27'}, {val:'28'}, {val:'29'}, {val:'30'},
        {val:'31'}
    ];

    $scope.bulan = [
        {val:'1', bulan:'Januari'}, {val:'2', bulan:'Februari'}, {val:'3', bulan:'Maret'}, {val:'4', bulan:'April'},
        {val:'5', bulan:'Mei'}, {val:'6', bulan:'Juni'}, {val:'7', bulan:'Juli'}, {val:'8', bulan:'Agustus'},
        {val:'9', bulan:'September'}, {val:'10', bulan:'Oktober'}, {val:'11', bulan:'November'}, {val:'12', bulan:'Desember'}
    ];

    $scope.tahun = [
        {val:'2016', tahun:'2016'}, {val:'2017', tahun:'2017'}
    ];

    $scope.sts = [
        {val:'1', st:'Staff'}, {val:'2', st:'Supervisor'}, {val:'3', st:'Manager'}, {val:'4', st:'HRD'}
    ];

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

    $scope.ambilUserById = function () {
        if (selfUrl == '::1') {
            selfUrl = 'localhost';

        }
        $http.post('http://' + selfUrl + '/PsProjectEmpPayRoll/system.php?p=karyawan&f=getdatakarid', {
            'idTxt': $routeParams.idkaryawan,
            'token': localStorage.getItem('token')
        }).
            success(function (data) {
                $scope.editkaryawan = data[0];
                console.log(data[0]);

                $scope.nik = data[0].nik;
                var splitNama = data[0].nama.split(' ');
                $scope.namaD = splitNama[0];
                $scope.namaB = splitNama[1];
                var kelahiran = data[0].kelahiran.split('-')
                $scope.tglLahir = kelahiran[0];
                $scope.blnLahir = kelahiran[1];
                $scope.thnLahir = kelahiran[2];
                var gapok = data[0].gajiPokok.replace(/\,/g,'');

                $scope.gapok = gapok;
                $scope.statusKar = data[0].jabatan;
                $scope.telpon = data[0].telpon;
                $scope.alamat = data[0].alamat;
                $scope.id = data[0].idKar;

            }).
            error(function (data, status, header, config) {
                console.log('D :' + data, 'S :' + status, 'H :' + header, 'C :' + config);
                //$location.path('/admin');
                $scope.apply();
            })
    }

    $scope.postSlip = function () {
        if (selfUrl == '::1') {
            selfUrl = 'localhost';

        }
        $http.post('http://' + selfUrl + '/PsProjectEmpPayRoll/system.php?p=karyawan&f=inslip', {
            'token': localStorage.getItem('token')
        }).
            success(function (data) {
                console.log(data);
                $scope.ambilAllUserSlip();
            }).
            error(function (data, status, header, config) {
                console.log('D :' + data, 'S :' + status, 'H :' + header, 'C :' + config);
                //$location.path('/admin');
                $scope.apply();
            })
    }

    $scope.ambilAllUser = function () {
        if (selfUrl == '::1') {
            selfUrl = 'localhost';

        }
        $http.post('http://' + selfUrl + '/PsProjectEmpPayRoll/system.php?p=karyawan&f=getalldatakaryawan', {
            'token': localStorage.getItem('token')
        }).
            success(function (data) {
                console.log(data);
                $scope.allkaryawan = data;
            }).
            error(function (data, status, header, config) {
                console.log('D :' + data, 'S :' + status, 'H :' + header, 'C :' + config);
                $scope.apply();
            })
    }

    $scope.ambilAllUserSlip = function () {
        if (selfUrl == '::1') {
            selfUrl = 'localhost';

        }
        $http.post('http://' + selfUrl + '/PsProjectEmpPayRoll/system.php?p=karyawan&f=getslip', {
            'token': localStorage.getItem('token')
        }).
            success(function (data) {
                console.log(data);
                $scope.allSlipKar = data;
            }).
            error(function (data, status, header, config) {
                console.log('D :' + data, 'S :' + status, 'H :' + header, 'C :' + config);
                $scope.apply();
            })
    }

    $scope.ambilUserSlipId = function () {
        if (selfUrl == '::1') {
            selfUrl = 'localhost';

        }
        $http.post('http://' + selfUrl + '/PsProjectEmpPayRoll/system.php?p=karyawan&f=getslipid', {
            'token': localStorage.getItem('token')
        }).
            success(function (data) {
                console.log(data[0]);
                $scope.slipKarId = data[0];
            }).
            error(function (data, status, header, config) {
                console.log('D :' + data, 'S :' + status, 'H :' + header, 'C :' + config);
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

                    if (typeof(Storage) !== "undefined") {
                        localStorage.setItem("token", d.token);
                        localStorage.setItem("stat", d.stat);

                        if(localStorage.getItem('stat') == '4') {
                            $location.path('/karyawan');
                        } else {
                            $location.path('/hrd');
                        }
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


    $scope.ubahPass = function () {
        if (selfUrl == '::1') {
            selfUrl = 'localhost';

        }
        $http.post('http://' + selfUrl + '/PsProjectEmpPayRoll/system.php?p=karyawan&f=ubahpass', {
            'oldPassTxt': $scope.oldpass,
            'newPassTxt': $scope.pass,
            'token': localStorage.getItem('token')
        }).
            success(function (data) {
                $scope.oldpass = null;
                $scope.pass = null;
                $scope.repass = null;

                $scope.dResPass = data;

                console.log(data);
            }).
            error(function (data, status, header, config) {
                console.log('D :' + data, 'S :' + status, 'H :' + header, 'C :' + config);
                //$location.path('/admin');
                $scope.apply();
            })
    }

    $scope.checkPass = function () {
        var pass = $scope.pass;
        var repass = $scope.repass;

        if(pass == repass) {
            $scope.msg = null;
        } else {
            $scope.msg = 'Password tidak cocok';
        }
    }

    $scope.newKar = function () {
        if (selfUrl == '::1') {
            selfUrl = 'localhost';
        }
        $http.post('http://' + selfUrl + '/PsProjectEmpPayRoll/system.php?p=karyawan&f=newkaryawan', {
            'nikTxt': $scope.nik,
            'namaDepanTxt': $scope.namaD,
            'namaBelakangTxt': $scope.namaB,
            'gajipokokTxt': $scope.gapok,
            'telponTxt': $scope.telpon,
            'tglLahirTxt': $scope.tglLahir,
            'blnLahirxt': $scope.blnLahir,
            'thnLahirTxt': $scope.thnLahir,
            'statusTxt': $scope.statusKar,
            'alamatTxt': $scope.alamat,
            'token': localStorage.getItem('token')
        }).
            success(function (data) {
                var d = $scope.dataKar = data;

                console.log(d);

                if (d.err === 'false') {
                    $scope.nik = null;
                    $scope.namaD = null;
                    $scope.namaB = null;
                    $scope.telpon = null;
                    $scope.tglLahir = null;
                    $scope.blnLahir = null;
                    $scope.thnLahir = null;
                    $scope.statusKar = null;
                    $scope.alamat = null;

                } else {
                    console.log('DATA : '+data);
                }
            }).
            error(function (data, status, header, config) {
                console.log('D :' + data, 'S :' + status, 'H :' + header, 'C :' + config);
                //$location.path('/admin');
                $scope.apply();
            })
    }

    $scope.updateKar = function () {
        if (selfUrl == '::1') {
            selfUrl = 'localhost';
        }
        $http.post('http://' + selfUrl + '/PsProjectEmpPayRoll/system.php?p=karyawan&f=updatekaryawan', {
            'idTxt': $scope.id,
            'nikTxt': $scope.nik,
            'namaDepanTxt': $scope.namaD,
            'namaBelakangTxt': $scope.namaB,
            'gajipokokTxt': $scope.gapok,
            'telponTxt': $scope.telpon,
            'tglLahirTxt': $scope.tglLahir,
            'blnLahirxt': $scope.blnLahir,
            'thnLahirTxt': $scope.thnLahir,
            'statusTxt': $scope.statusKar,
            'alamatTxt': $scope.alamat,
            'token': localStorage.getItem('token')
        }).
            success(function (data) {
                var d = $scope.dataKar = data;

                console.log(d);

                if (d.err === 'false') {
                    $scope.nik = null;
                    $scope.namaD = null;
                    $scope.namaB = null;
                    $scope.gapok = null;
                    $scope.telpon = null;
                    $scope.tglLahir = null;
                    $scope.blnLahir = null;
                    $scope.thnLahir = null;
                    $scope.statusKar = null;
                    $scope.alamat = null;

                    $location.path('/datakar');
                } else {
                    console.log('DATA : '+data);
                }
            }).
            error(function (data, status, header, config) {
                console.log('D :' + data, 'S :' + status, 'H :' + header, 'C :' + config);
                //$location.path('/admin');
                $scope.apply();
            })
    }
});