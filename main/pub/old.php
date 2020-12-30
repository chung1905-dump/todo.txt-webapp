<?php
require_once(__DIR__ . '/../includes/config.php');
require_once(__DIR__ . '/../includes/todo.php');

if (str_starts_with($_SERVER['REQUEST_URI'], '/api/')) {
    require_once(__DIR__ . '/../app/main.php');
    exit();
}

$cmd = get_cmd($_POST);
$cmd2 = get_cmd($_POST, 'cmd2');
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 TRANSITIONAL//EN">
<html>
<head>
    <meta http-equiv="Content-type" value="text/html; charset=utf-8">
    <title>todo.txt</title>

    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1,user-scalable=0"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <link rel="apple-touch-icon" sizes="180x180" href="media/favicon/icon_180.png"/>

    <link media="screen" href="css/stylesheet.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script type="text/javascript" src="js/todo.js"></script>
</head>

<body>
<div id="container">
    <div id="top">
        <h1><a href="<?php echo $todoUrl; ?>">todo.txt</a></h1>
        <label><input type="text" name="new_todo"></label>
        <button name="submit">Add</button>
    </div>

    <div id="output">
        <?php
        // run todo.sh and print list
        run_todo($cmd);

        // rerun the previous list command if current command is not a list
        if (isset($cmd2) && !ls_check($cmd)) {
            run_todo($cmd2);
        }
        ?>
    </div>
</div>
</body>
</html>
