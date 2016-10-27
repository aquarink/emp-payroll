<?php

require_once 'Koneksi.php';

class CutiModel {

    public $panggilKoneksi;

    function __construct() {
        $koneksi = new Koneksi();
        $this->panggilKoneksi = $koneksi->KoneksiDatabase();
        return $this->panggilKoneksi;
    }

    public function inCuti($id_kar,$tgl_mulai,$tgl_selesai,$lama_cuti,$alasan,$status,$cre_cuti) {
        $query = $this->panggilKoneksi->prepare("INSERT INTO cutiTb (id_kar,tgl_mulai,tgl_selesai,lama_cuti, alasan,status,cre_cuti) VALUES(?,?,?,?,?,?,?)");
        $data = array($id_kar,$tgl_mulai,$tgl_selesai,$lama_cuti,$alasan,$status,$cre_cuti);
        $query->execute($data);
        $result = $query->rowCount();
        return $result;
    }

    public function hitCuti($id_kar) {
        $query = $this->panggilKoneksi->prepare("SELECT * FROM cutiTb WHERE id_kar = ?");
        $data = array($id_kar);
        $query->execute($data);
        $result = $query->fetchAll();
        return $result;
    }
}