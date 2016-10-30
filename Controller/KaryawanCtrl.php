<?php

class KaryawanCtrl {

    public function Index() {
        echo '{"err" : "true", "msg" : "Forbhident"}';
    }

    public function Newkaryawan()
    {
        $data = file_get_contents('php://input');
        $datanya = json_decode($data);

        if (empty($datanya)) {
            echo '{"err" : "true", "msg" : "Field Kosong"}';
        } else {
            include_once 'Model/KaryawanModel.php';
            $karyawan = new KaryawanModel();

            $token = $datanya->token;

            $ambilKaryawan = $karyawan->getDataToken($token);
            foreach ($ambilKaryawan as $dl) {
                if($dl['stat'] == 4) {
                    $nik = $datanya->nikTxt;
                    $namaD = $datanya->namaDepanTxt;
                    $namaB = $datanya->namaBelakangTxt;
                    $tel = $datanya->telponTxt;
                    $tglLhr = $datanya->tglLahirTxt;
                    $blnLhr = $datanya->blnLahirxt;
                    $thnLhr = $datanya->thnLahirTxt;
                    $stat = $datanya->statusTxt;
                    $alamat = $datanya->alamatTxt;
                    $gaji = $datanya->gajipokokTxt;

                    $kel = $tglLhr.'-'.$blnLhr.'-'.$thnLhr;
                    $nama = $namaD.' '.$namaB;
                    $token = md5($nik);
                    $pas = md5($tglLhr.$blnLhr.$thnLhr);
                    $del = 1;
                    $create = date('Y-m-d h:i:s');

                    $saveKar = $karyawan->newKaryawan($nik, $kel, $tel, $pas, $nama, $gaji, $alamat, $stat, $token, $del, $create);
                    if($saveKar > 0) {
                        echo '{"err" : "false", "msg" : "Data Karyawan Baru Berhasil Ditambah"}';
                    } else {
                        echo '{"err" : "true", "msg" : "Query save kar Gagal"}';
                    }
                } else {
                    echo '{"err" : "true", "msg" : "Anda bukan HRD"}';
                }
            }
        }
    }

    public function Updatekaryawan()
    {
        $data = file_get_contents('php://input');
        $datanya = json_decode($data);

        if (empty($datanya)) {
            echo '{"err" : "true", "msg" : "Field Kosong"}';
        } else {
            include_once 'Model/KaryawanModel.php';
            $karyawan = new KaryawanModel();

            $token = $datanya->token;

            $ambilKaryawan = $karyawan->getDataToken($token);
            foreach ($ambilKaryawan as $dl) {
                if($dl['stat'] == 4) {
                    $id = $datanya->idTxt;
                    $nik = $datanya->nikTxt;
                    $namaD = $datanya->namaDepanTxt;
                    $namaB = $datanya->namaBelakangTxt;
                    $tel = $datanya->telponTxt;
                    $tglLhr = $datanya->tglLahirTxt;
                    $blnLhr = $datanya->blnLahirxt;
                    $thnLhr = $datanya->thnLahirTxt;
                    $stat = $datanya->statusTxt;
                    $alamat = $datanya->alamatTxt;
                    $gaji = $datanya->gajipokokTxt;

                    $kel = $tglLhr.'-'.$blnLhr.'-'.$thnLhr;
                    $nama = $namaD.' '.$namaB;

                    $updateKar = $karyawan->updateKaryawan($nik,$kel,$tel,$nama,$gaji,$alamat,$stat, $id);
                    if($updateKar > 0) {
                        echo '{"err" : "false", "msg" : "Data Karyawan Baru Berhasil Diubah"}';
                    } else {
                        echo '{"err" : "true", "msg" : "Query ubah kar Gagal"}';
                    }
                } else {
                    echo '{"err" : "true", "msg" : "Anda bukan HRD"}';
                }
            }
        }
    }

    public function Login() {

        $data = file_get_contents('php://input');
        $datanya = json_decode($data);

        if(empty($datanya)) {
            echo '{"err" : "true", "msg" : "Field Kosong"}';
        } else {
            include_once 'Model/KaryawanModel.php';
            $karyawan = new KaryawanModel();

            $nik= $datanya->nipTxt;
            $pas = md5($datanya->passTxt);

            $loginKaryawan = $karyawan->getLogin($nik, $pas);
            if($loginKaryawan > 0) {

                $dataAftLogin = $karyawan->getDataLogin($nik);

                foreach($dataAftLogin as $dl) {
                    $_SESSION['sessiKey'] = $dl['token_kar'];
                    echo '{"err" : "false", "token" : "'.$dl['token_kar'].'", "stat" : "'.$dl['stat'].'"}';
                }
            } else {
                echo '{"err" : "true", "msg" : "Username & Nik Salah"}';
            }
        }
    }

    public function Getalldatakaryawan()
    {
        $data = file_get_contents('php://input');
        $datanya = json_decode($data);

        if (empty($datanya)) {
            echo '{"err" : "true", "msg" : "Field Kosong"}';
        } else {
            include_once 'Model/KaryawanModel.php';
            $karyawan = new KaryawanModel();

            $token = $datanya->token;

            $ambilKaryawan = $karyawan->getDataToken($token);
            foreach ($ambilKaryawan as $dl) {
                if($dl['stat'] == 4) {
                    $allDataKar = $karyawan->getAllData();
                    foreach($allDataKar as $allKar) {
                        $sendData[] = array(
                            'nama'=>$allKar['nama_kar'], 'jabatan'=>$allKar['stat'], 'mulaiKerja'=>$allKar['cre_kar'],
                            'telpon'=>$allKar['telpon'], 'alamat'=>$allKar['alamat'], 'gajiPokok'=>number_format($allKar['gajipokok']),
                            'idKar'=>$allKar['id_kar']
                        );
                    }

                    echo json_encode($sendData);
                } else {
                    echo '{"err" : "true", "msg" : "Anda bukan HRD"}';
                }
            }
        }
    }

    public function Getdatakarid()
    {
        $data = file_get_contents('php://input');
        $datanya = json_decode($data);

        if (empty($datanya)) {
            echo '{"err" : "true", "msg" : "Field Kosong"}';
        } else {
            include_once 'Model/KaryawanModel.php';
            $karyawan = new KaryawanModel();

            $token = $datanya->token;
            $idKar = $datanya->idTxt;

            $ambilKaryawan = $karyawan->getDataToken($token);
            foreach ($ambilKaryawan as $dl) {
                if($dl['stat'] == 4) {
                    $dataKarId = $karyawan->KaryawanId($idKar);
                    foreach($dataKarId as $allKar) {
                        $sendData[] = array(
                            'nama'=>$allKar['nama_kar'], 'jabatan'=>$allKar['stat'], 'mulaiKerja'=>$allKar['cre_kar'],
                            'telpon'=>$allKar['telpon'], 'alamat'=>$allKar['alamat'], 'gajiPokok'=>number_format($allKar['gajipokok']),
                            'idKar'=>$allKar['id_kar'], 'nik'=>$allKar['nik'], 'kelahiran'=>$allKar['tgl_lahir']
                        );
                    }

                    echo json_encode($sendData);
                } else {
                    echo '{"err" : "true", "msg" : "Anda bukan HRD"}';
                }
            }
        }
    }

    public function Getslip()
    {
        $data = file_get_contents('php://input');
        $datanya = json_decode($data);

        if (empty($datanya)) {
            echo '{"err" : "true", "msg" : "Field Kosong"}';
        } else {
            include_once 'Model/KaryawanModel.php';
            $karyawan = new KaryawanModel();

            $token = $datanya->token;
            $bulan = number_format(date('m'));
            $sekarang = date('y-m-d');

            $ambilKaryawan = $karyawan->getDataToken($token);
            foreach ($ambilKaryawan as $dl) {
                if($dl['stat'] == 4) {
                    $allDataSlip = $karyawan->karyawanSlip($bulan);
                    foreach($allDataSlip as $allKar) {

                        $sendData[] = array(
                            'nik'=>$allKar['nik'], 'nama'=>$allKar['nama_kar'], 'jabatan'=>$allKar['stat'],
                            'gapok'=>$allKar['gajipokok'], 'cetak'=>$allKar['tgl_cetak'], 'status'=>$allKar['st'],
                            'idSlip'=>$allKar['id_slip']
                        );
                    }

                    echo json_encode($sendData);
                } else {
                    echo '{"err" : "true", "msg" : "Anda bukan HRD"}';
                }
            }
        }
    }

    public function Getslipid()
    {
        $data = file_get_contents('php://input');
        $datanya = json_decode($data);

        if (empty($datanya)) {
            echo '{"err" : "true", "msg" : "Field Kosong"}';
        } else {
            include_once 'Model/KaryawanModel.php';
            $karyawan = new KaryawanModel();

            $token = $datanya->token;
            $bulan = number_format(date('m'));

            $ambilKaryawan = $karyawan->getDataToken($token);
            foreach ($ambilKaryawan as $dl) {
                $dataSlipId = $karyawan->karyawanSlipId($dl['id_kar'],$bulan);
                foreach($dataSlipId as $allKar) {

                    $sendData[] = array(
                        'nik' => $allKar['nik'], 'nama' => $allKar['nama_kar'], 'jabatan' => $allKar['stat'],
                        'gapok' => number_format($allKar['gajipokok']), 'cetak' => $allKar['tgl_cetak'], 'status' => $allKar['st'],
                        'idSlip' => $allKar['id_slip'], 'blanCtak' => $bulan
                    );
                }

                echo json_encode($sendData);
            }
        }
    }

    public function Inslip()
    {
        $data = file_get_contents('php://input');
        $datanya = json_decode($data);

        if (empty($datanya)) {
            echo '{"err" : "true", "msg" : "Field Kosong"}';
        } else {
            include_once 'Model/KaryawanModel.php';
            $karyawan = new KaryawanModel();

            $token = $datanya->token;
            $bulan = date('m');
            $sekarang = date('y-m-d');

            $ambilKaryawan = $karyawan->getDataToken($token);
            foreach ($ambilKaryawan as $dl) {
                if($dl['stat'] == 4) {
                    $allDataKar = $karyawan->getAllData();
                    foreach($allDataKar as $allKar) {

                        $cekSlipKar = $karyawan->cekSlip($allKar['id_kar'], $bulan);
                        if(empty($cekSlipKar)) {
                            $inputSlip = $karyawan->inSlip($allKar['id_kar'], $allKar['gajipokok'], $bulan, $sekarang, 1);
                        }
                    }
                    echo '{"err" : "false", "msg" : "Slip Gaji Sudah Dikirim"}';
                } else {
                    echo '{"err" : "true", "msg" : "Anda bukan HRD"}';
                }
            }
        }
    }

    public function Getdatakaryawan()
    {
        $data = file_get_contents('php://input');
        $datanya = json_decode($data);

        if (empty($datanya)) {
            echo '{"err" : "true", "msg" : "Field Kosong"}';
        } else {
            include_once 'Model/KaryawanModel.php';
            $karyawan = new KaryawanModel();

            $token = $datanya->token;

            $ambilKaryawan = $karyawan->getDataToken($token);
            foreach ($ambilKaryawan as $dl) {
                echo json_encode($dl);
            }
        }
    }

    public function Ubahpass()
    {
        $data = file_get_contents('php://input');
        $datanya = json_decode($data);

        if (empty($datanya)) {
            echo '{"err" : "true", "msg" : "Field Kosong"}';
        } else {
            include_once 'Model/KaryawanModel.php';
            $karyawan = new KaryawanModel();

            $token = $datanya->token;
            $oldPass = $datanya->oldPassTxt;
            $newPass = $datanya->newPassTxt;

            $ambilKaryawan = $karyawan->getDataToken($token);
            foreach ($ambilKaryawan as $dl) {

                $cekOldPass = $karyawan->cekPassId($dl['id_kar'], $oldPass);
                if($cekOldPass > 0) {
                    $ubahPass = $karyawan->ubahPass($newPass, $dl['id_kar']);
                    if($ubahPass > 0) {
                        echo '{"err" : "false", "msg" : "Berhasil Ubah Password"}';
                    } else {
                        echo '{"err" : "true", "msg" : "Gagal Ubah Password"}';
                    }
                } else {
                    echo '{"err" : "true", "msg" : "Password Lama Tidak Sesuai"}';
                }

            }
        }
    }
}