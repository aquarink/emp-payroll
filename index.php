<?php

include_once 'Controller/Route.php';
$route = new Route();

if(isset($_GET['p'])) {

    if(empty($_GET['p'])) {

        if(empty($_GET['f'])) {
            $function = $route->FuncRoute('Index', 'Index');
        } else {
            $function = ucfirst($_GET['f']);
            $function = $route->FuncRoute('Index', $function);
        }
    } else {
        $ctrlClass = $_GET['p'];
        if(empty($_GET['f'])) {
            $function = 'Index';
            $function = $route->FuncRoute($ctrlClass, $function);
        } else {
            $function = ucfirst($_GET['f']);
            $function = $route->FuncRoute($ctrlClass, $function);
        }
    }
} else {

    if(isset($_GET['f'])) {
        $function = ucfirst($_GET['f']);
        $function = $route->FuncRoute('Index', $function);
    } else {
        $function = $route->FuncRoute('Index', 'Index');
    }
}
