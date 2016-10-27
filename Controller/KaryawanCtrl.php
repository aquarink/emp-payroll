<?php

class KaryawanCtrl {

    public function Index() {
        echo 'Forbhident';
    }

    public function Login() {

        $data = file_get_contents('php://input');
        $datanya = json_decode($data);

        if(empty($datanya)) {
            echo 'kosong';
        } else {
            include_once 'Model/KaryawanModel.php';
            $karyawan = new KaryawanModel();

            $nik= $datanya->nipTxt;
            $pas = $datanya->passTxt;

            $loginKaryawan = $karyawan->getLogin($nik, $pas);
            if($loginKaryawan > 0) {

                $dataAftLogin = $karyawan->getDataLogin($nik);

                foreach($dataAftLogin as $dl) {
                    echo '{"err" : "false", "token" : "'.$dl['token_kar'].'"}';
                }
            } else {
                echo '{"err" : "true", "msg" : "Username & Nik Salah"}';
            }
        }
    }

    public function Getdatakaryawan()
    {
        $data = file_get_contents('php://input');
        $datanya = json_decode($data);

        if (empty($datanya)) {
            echo 'kosong';
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
}