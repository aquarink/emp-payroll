'use strict';

pebs.controller('cutiController', function ($scope, $http, $location) {
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
});