<?php

class KaryawanCtrl {

    public function Index() {
        echo 'Forbhident';
    }

    public function Login() {
        $data = file_get_contents('php://input');
        $datanya = json_decode($data);

        $a =+ json_encode($datanya);
        $a =+ '{err: "false"}';

        echo $a;

        $nip = $datanya->nipTxt;
        $pass = $datanya->passTxt;

        //echo $nip.' - '.$pass;
    }
}