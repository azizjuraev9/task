<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.10.2018
 * Time: 17:34
 */
//phpinfo();
//die;
require "lib/main/config.php";
require "lib/main/DB.php";
require "lib/main/Params.php";
require "lib/main/BaseClass.php";
require "lib/main/User.php";
require "lib/main/App.php";
spl_autoload_register(function ($class_name) {
    include 'lib/classes/' . $class_name . '.php';
});

$db = new DB();
$db->connect();
$params = new Params($db);
$user = new User($db, $params);
App::run($db, $params, $user);

?>

<html>
<head>
    <title>Random gifts</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/spinner.css" rel="stylesheet">
    <script>
        var token = "<?= App::$token; ?>";
        var rotate_cost = parseInt(<?= App::$params->get('rotate_cost'); ?>);
        var conversion_ratio = parseFloat(<?= App::$params->get('conversion_ratio'); ?>);
    </script>
</head>
<body>
<?php include("view_parts/top-panel.php") ?>

<?php if(isset(App::$view_params['include'])) include('view_parts/'.App::$view_params['include'].'.php'); ?>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="assets/js/spinner.js"></script>
</body>
</html>



