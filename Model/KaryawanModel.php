<?php

require_once 'Koneksi.php';

class KaryawanModel {

    public $panggilKoneksi;

    function __construct() {
        $koneksi = new Koneksi();
        $this->panggilKoneksi = $koneksi->KoneksiDatabase();
        return $this->panggilKoneksi;
    }

    public function getLogin($nik, $pas) {
        $query = $this->panggilKoneksi->prepare("SELECT * FROM karyawantb WHERE nik = ? AND password = ?");
        $data = array($nik, $pas);
        $query->execute($data);
        $result = $query->rowCount();
        return $result;
    }

    public function getDataLogin($nik) {
        $query = $this->panggilKoneksi->prepare("SELECT * FROM karyawantb WHERE nik = ?");
        $data = array($nik);
        $query->execute($data);
        $result = $query->fetchAll();
        return $result;
    }

    public function getDataToken($token) {
        $query = $this->panggilKoneksi->prepare("SELECT id_kar, nik, tgl_lahir, telpon, nama_kar, alamat, status, cre_kar FROM karyawantb WHERE token_kar = ?");
        $data = array($token);
        $query->execute($data);
        $result = $query->fetchAll();
        return $result;
    }

    public function cekDataToken($token) {
        $query = $this->panggilKoneksi->prepare("SELECT * FROM karyawantb WHERE token_kar = ?");
        $data = array($token);
        $query->execute($data);
        $result = $query->rowCount();
        return $result;
    }
}