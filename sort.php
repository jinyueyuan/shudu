<?php
require_once('handle.php');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>数独游戏</title>
    <link href="shudustyle.css" rel="stylesheet">
</head>
<body>
<div id="sortface" align="center">
    <p>排名</p>
    <table>
        <?php
        $sortobj = new handle();
        $sortobj->sort();
        ?>
    </table>
</div>
<div id="but" align="center">
    <button onclick="javascript:window.location='start.php'">返回</button>
</div>
</body>
</html>