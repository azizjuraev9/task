<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.10.2018
 * Time: 13:55
 */

require "lib/main/config.php";
require "lib/main/DB.php";
require "lib/main/Params.php";
require "lib/main/BaseClass.php";
require "lib/main/User.php";
require "lib/main/App.php";
require "lib/main/AdminApp.php";
spl_autoload_register(function ($class_name) {
    include 'lib/classes/'.$class_name . '.php';
});

$db = new DB();
$db->connect();
$params = new Params($db);
$user = new User($db,$params);
AdminApp::run($db,$params,$user);
?>
<html>
    <head>
        <title>ADMIN</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="/assets/css/style.css" rel="stylesheet">
    </head>
    <body>
    <?php include("view_parts/admin/admin-menu.php") ?>

    <?php if(isset(AdminApp::$view_params['include'])) include('view_parts/admin/'.AdminApp::$view_params['include'].'.php'); ?>

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/script.js"></script>
    </body>
</html>
