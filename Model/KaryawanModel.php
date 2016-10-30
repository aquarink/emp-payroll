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

    public function newKaryawan($nik, $kelahiran, $tlp, $pass, $nama, $gapok, $alamat, $stat, $token, $del, $create) {
        $query = $this->panggilKoneksi->prepare("INSERT INTO karyawantb (nik, tgl_lahir, telpon, password, nama_kar, gajipokok, alamat, stat, token_kar, del_kar, cre_kar) VALUES(?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $data = array($nik, $kelahiran, $tlp, $pass, $nama, $gapok, $alamat, $stat, $token, $del, $create);
        $query->execute($data);
        $result = $query->rowCount();
        return $result;
    }

    public function updateKaryawan($nik, $kelahiran, $tlp, $nama, $gapok, $alamat, $stat, $id) {
        $query = $this->panggilKoneksi->prepare("UPDATE karyawantb SET nik = ?, tgl_lahir = ?, telpon = ?, nama_kar = ?, gajipokok = ?, alamat = ?, stat = ? WHERE id_kar = ?");
        $data = array($nik, $kelahiran, $tlp, $nama, $gapok, $alamat, $stat, $id);
        $query->execute($data);
        $result = $query->rowCount();
        return $result;
    }

    public function getDataToken($token) {
        $query = $this->panggilKoneksi->prepare("SELECT id_kar, nik, tgl_lahir, telpon, nama_kar, alamat, stat, cre_kar FROM karyawantb WHERE token_kar = ?");
        $data = array($token);
        $query->execute($data);
        $result = $query->fetchAll();
        return $result;
    }

    public function getAllData() {
        $query = $this->panggilKoneksi->prepare("SELECT id_kar, nik, tgl_lahir, telpon, nama_kar, gajipokok, alamat, stat, cre_kar FROM karyawantb");
        $query->execute();
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

    public function KaryawanId($id) {
        $query = $this->panggilKoneksi->prepare("SELECT * FROM karyawantb WHERE id_kar = ?");
        $data = array($id);
        $query->execute($data);
        $result = $query->fetchAll();
        return $result;
    }

    public function cekPassId($id,$pass) {
        $query = $this->panggilKoneksi->prepare("SELECT * FROM karyawantb WHERE id_kar = ? AND password = ?");
        $data = array($id,$pass);
        $query->execute($data);
        $result = $query->rowCount();
        return $result;
    }

    public function ubahPass($pass, $id) {
        $query = $this->panggilKoneksi->prepare("UPDATE karyawantb SET password = ? WHERE id_kar = ?");
        $data = array($pass, $id);
        $query->execute($data);
        $result = $query->rowCount();
        return $result;
    }

    public function inSlip($idKar, $gaji, $bulan, $cetak, $st) {
        $query = $this->panggilKoneksi->prepare("INSERT INTO slipTb (id_kar, gaji, bulan, tgl_cetak, st) VALUES(?, ?, ?, ?, ?)");
        $data = array($idKar, $gaji, $bulan, $cetak, $st);
        $query->execute($data);
        $result = $query->rowCount();
        return $result;
    }

    public function cekSlip($idKar, $bulan) {
        $query = $this->panggilKoneksi->prepare("SELECT * FROM slipTb WHERE id_kar = ? AND bulan = ?");
        $data = array($idKar, $bulan);
        $query->execute($data);
        $result = $query->rowCount();
        return $result;
    }

    public function karyawanSlip($bulan) {
        $query = $this->panggilKoneksi->prepare("SELECT * FROM slipTb, karyawantb WHERE karyawantb.`id_kar` = slipTb.`id_kar` AND slipTb.`bulan` = ?");
        $data = array($bulan);
        $query->execute($data);
        $result = $query->fetchAll();
        return $result;
    }

    public function karyawanSlipId($id, $bulan) {
        $query = $this->panggilKoneksi->prepare("SELECT * FROM slipTb, karyawantb WHERE karyawantb.`id_kar` = ? AND slipTb.`id_kar` = ? AND slipTb.`bulan` = ?");
        $data = array($id, $id, $bulan);
        $query->execute($data);
        $result = $query->fetchAll();
        return $result;
    }
}