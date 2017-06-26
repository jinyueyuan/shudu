<!--游戏开始界面-->
<?php
require_once('handle.php');
$obj = new handle();
$obj->han();
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
<body onload="load()">
<div id="big">
    <div id="content" align="center">
        <p>对数独进行运算</p>
        <form action="start.php" method="post" name="form">
            <div>
                <input type="submit" name="submitted" value="新建游戏" />
                &nbsp;&nbsp;&nbsp;
                <input type="reset"  value="重新开始" onclick="loadagain()" />
                &nbsp;&nbsp;&nbsp;
                <?php echo "计时: ";?><input name=showTime size=11 readonly="true" />
            </div>
            <div id="answer">
                <?php
                $obj->show();
                ?>
            </div>
        </form>
    </div>
    <div id="sort" align="center">
        <form action="sort.php" method="post">
            <div>
                <input type="submit" name="submitted" value="本系统排名"/>
                &nbsp;
                <input type="submit" name="submitted" value="总排名"/>
            </div>
        </form>
    </div>
</div>
</body>
</html>
<script language="JavaScript">
        var HH = 0;
        var mm = 0;
        var ss = 0;
        function loadagain(){
            document.form.showTime.value = '';
            HH = 0;
            mm = 0;
            ss = 0;
        }
        function load() {
            clearInterval(timer);
            var timer = setInterval(function loads() {
                str = "";
                if (++ss == 60) {
                    if (++mm == 60) {
                        HH++;
                        mm = 0;
                    }
                    ss = 0;
                }
                str += HH < 10 ? "0" + HH : HH;
                str += ":";
                str += mm < 10 ? "0" + mm : mm;
                str += ":";
                str += ss < 10 ? "0" + ss : ss;
                document.form.showTime.value = str;
            }, 1000);
        }
</script>
