<?php

class Route {

    public function FuncRoute($p, $f) {

        include_once 'Controller/'.ucfirst($p).'Ctrl.php';
        $cls = ucfirst($p).'Ctrl';
        $controll = new $cls();
        $controll->$f();
    }
}