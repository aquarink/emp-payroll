<!DOCTYPE html>
<html ng-app="pebApp">
<head>
    <meta charset="UTF-8">
    <title ng-bind="title + ' - Arya App'">Default</title>
    <script type="text/javascript" src="Modul/Angularjs/angular.js"></script>
    <script type="text/javascript" src="Modul/Angularjs/angular-route.js"></script>
    <script type="text/javascript" src="Modul/Angularjs/angular-resource.js"></script>
    <script type="text/javascript" src="Modul/Angularjs/angular-app.js"></script>
    <link type="text/css" rel="stylesheet" href="Modul/Bootstrap/css/bootstrap.css" media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <script type="text/javascript" src="Modul/Angularjs/JsController/JsLoginCtrl.js"></script>
    <script type="text/javascript" src="Modul/Angularjs/JsController/JsCutiCtrl.js"></script>

    <script>var selfUrl = '<?php echo $_SERVER['SERVER_ADDR']; ?>';</script>
</head>
<body style="background-color: #c7c7c7">

<div ng-view></div>

<script type="text/javascript" src="Modul/Bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="Modul/Bootstrap/js/bootstrap.min.js"></script>

</body>
</html>