<?php

class CutiCtrl {

    public function Index() {
        echo '{"err" : "true", "msg" : "Forbhiden"}';
    }

    public function Hitcuti() {
        $data = file_get_contents('php://input');
        $datanya = json_decode($data);

        if(empty($datanya)) {
            echo '{"err" : "true", "msg" : "Field Kosong"}';
        } else {
            include_once 'Model/KaryawanModel.php';
            $karyawan = new KaryawanModel();

            $token = $datanya->token;

            $cekToken = $karyawan->cekDataToken($token);
            if($cekToken > 0) {

                $dataToken = $karyawan->getDataToken($token);

                foreach($dataToken as $dataKarywan) {
                    include_once 'Model/CutiModel.php';
                    $cuti = new CutiModel();
                    $idKar = $dataKarywan['id_kar'];
                    $cekCuti = $cuti->hitCuti($idKar);

                    foreach($cekCuti as $dataCuti) {
                        $lamaCuti[] = $dataCuti['lama_cuti'];
                    }

                    $hitLamaCuti = array_sum($lamaCuti);
                    $sisaCuti = 12-$hitLamaCuti;
                    echo '{"err" : "false", "takeCuti" : "'.$hitLamaCuti.'", "sisaCuti" : "'.$sisaCuti.'"}';
                }

            } else {
                echo '{"err" : "true", "msg" : "Data tidak ditemukan"}';
            }
        }
    }

    public function Setstatuscuti() {
        $data = file_get_contents('php://input');
        $datanya = json_decode($data);

        if(empty($datanya)) {
            echo '{"err" : "true", "msg" : "Field Kosong"}';
        } else {
            include_once 'Model/KaryawanModel.php';
            $karyawan = new KaryawanModel();

            $token = $datanya->token;

            $cekToken = $karyawan->cekDataToken($token);
            if($cekToken > 0) {

                $dataToken = $karyawan->getDataToken($token);

                foreach($dataToken as $dl) {
                    if($dl['stat'] == 4) {
                        include_once 'Model/CutiModel.php';
                        $cuti = new CutiModel();

                        echo $getStat = $datanya->setStat;
                        $getId = $datanya->setId;

                        $statCuti = $cuti->setStatCuti($getStat, $getId);
                        if($statCuti > 0) {
                            echo '{"err" : "false", "msg" : "Pengajuan Cuti Diterima"}';
                        } else {
                            echo '{"err" : "true", "msg" : "Kesalahan Query Stst Cuti"}';
                        }
                    } else {
                        echo '{"err" : "true", "msg" : "Anda bukan HRD"}';
                    }
                }

            } else {
                echo '{"err" : "true", "msg" : "Data tidak ditemukan"}';
            }
        }
    }

    public function Statuscuti() {
    $data = file_get_contents('php://input');
    $datanya = json_decode($data);

    if(empty($datanya)) {
        echo '{"err" : "true", "msg" : "Field Kosong"}';
    } else {
        include_once 'Model/KaryawanModel.php';
        $karyawan = new KaryawanModel();

        $token = $datanya->token;

        $cekToken = $karyawan->cekDataToken($token);
        if($cekToken > 0) {

            $dataToken = $karyawan->getDataToken($token);

            foreach($dataToken as $dl) {
                if($dl['stat'] == 4) {
                    include_once 'Model/CutiModel.php';
                    $cuti = new CutiModel();

                    $getStat = $datanya->setStat;

                    $statCuti = $cuti->statusCuti($getStat);
                    foreach($statCuti as $cutiOk) {
                        $cutiData[] = array(
                            'nama'=>$cutiOk['nama_kar'], 'jabatan'=>$cutiOk['stat'], 'mulaiCuti'=>$cutiOk['tgl_mulai'],
                            'selesaiCuti'=>$cutiOk['tgl_selesai'], 'lamaCuti'=>$cutiOk['lama_cuti'], 'alasan'=>$cutiOk['alasan'],
                            'idcuti'=>$cutiOk['id_cuti']
                        );
                    }

                    if(empty($cutiData)) {
                        echo '{"err" : "true", "msg" : "Data Kosong"}';
                    } else {
                        echo json_encode($cutiData);
                    }
                } else {
                    echo '{"err" : "true", "msg" : "Anda bukan HRD"}';
                }
            }

        } else {
            echo '{"err" : "true", "msg" : "Data tidak ditemukan"}';
        }
    }
}

    public function Reqcuti() {
        $data = file_get_contents('php://input');
        $datanya = json_decode($data);

        if(empty($datanya)) {
            echo '{"err" : "true", "msg" : "Field Kosong"}';
        } else {
            include_once 'Model/KaryawanModel.php';
            $karyawan = new KaryawanModel();

            $token = $datanya->token;

            $cekToken = $karyawan->cekDataToken($token);
            if($cekToken > 0) {

                $dataToken = $karyawan->getDataToken($token);

                foreach($dataToken as $dataKarywan) {
                    include_once 'Model/CutiModel.php';
                    $cuti = new CutiModel();

                    $idKar = $dataKarywan['id_kar'];

                    $Mtanggal= $datanya->MtanggalCutiTxt;
                    $Mbulan = $datanya->MbulanCutiTxt;
                    $Mtahun = $datanya->MtahunCutiTxt;
                    $mulai = $Mtanggal.'#'.$Mbulan.'#'.$Mtahun;

                    $Stanggal = $datanya->StanggalCutiTxt;
                    $Sbulan = $datanya->SbulanCutiTxt;
                    $Stahun = $datanya->StahunCutiTxt;
                    $selesai = $Stanggal.'#'.$Sbulan.'#'.$Stahun;

                    $ket = $datanya->ketCutiTxt;
                    $lama = $datanya->lamaCutiTxt;
                    $sekarang = date('Y-m-d h:i:s');

                    $requestCuti = $cuti->inCuti($idKar,$mulai,$selesai,$lama, $ket, 3, $sekarang);

                    if($requestCuti > 0) {
                        echo '{"err" : "false", "msg" : "Request Cuti '.$lama.' Hari Berhasil"}';
                    } else {
                        echo '{"err" : "true", "msg" : "Query Request Cuti"}';
                    }
                }
            } else {
                echo '{"err" : "true", "msg" : "Token Kosong"}';
            }
        }
    }

    public function Historicuti() {
        $data = file_get_contents('php://input');
        $datanya = json_decode($data);

        if(empty($datanya)) {
            echo '{"err" : "true", "msg" : "Field Kosong"}';
        } else {
            include_once 'Model/KaryawanModel.php';
            $karyawan = new KaryawanModel();

            $token = $datanya->token;

            $cekToken = $karyawan->cekDataToken($token);
            if($cekToken > 0) {

                $dataToken = $karyawan->getDataToken($token);

                foreach ($dataToken as $dataKarywan) {
                    include_once 'Model/CutiModel.php';
                    $cuti = new CutiModel();

                    $idKar = $dataKarywan['id_kar'];

                    $dataCutiKar = $cuti->hitCuti($idKar);

                    foreach($dataCutiKar as $dataCuti) {
                        $lamaCuti[] = $dataCuti;
                        $tglMulai = explode('#',$dataCuti['tgl_mulai']);
                        $tglM = $tglMulai[0];
                        $blnM = $tglMulai[1];
                        $thnM = $tglMulai[2];

                        $tglSelesai = explode('#',$dataCuti['tgl_selesai']);
                        $tglS = $tglSelesai[0];
                        $blnS = $tglSelesai[1];
                        $thnS = $tglSelesai[2];

                        $sendData[] = array(
                            'tglM'=>$tglM, 'blnM'=>$blnM, 'thnM'=>$thnM,
                            'tglS'=>$tglS, 'blnS'=>$blnS, 'thnS'=>$thnS,
                            'alasan'=>$dataCuti['alasan'],
                            'stat'=>$dataCuti['status'],
                            'jmlCuti'=>$dataCuti['lama_cuti']
                            );
                    }

                    echo json_encode($sendData);
                }
            } else {
                echo '{"err" : "true", "msg" : "Token Kosong"}';
            }
        }

    }

}