<?php
require_once('shudu.php');
require_once('writeDB.php');
date_default_timezone_set('prc');

/**
 * Created by PhpStorm.
 * User: jinzil
 * Date: 2016/1/3
 * Time: 11:36
 */
class handle
{
    private $arr;
    private $str;
    public function han()
    {
        if ( (isset($_POST['submitted']) && $_POST['submitted'] == "新建游戏")) {
            $startime = time();
            setcookie('starttime', $startime, time() + 3600, '/');
            $obj = new shudu();
            $resultarr = $obj->main();
            $this->arr = $obj->select();
            $resultstr = serialize($resultarr);
            setcookie('resultstr', $resultstr, time() + 3600, '/');
        }
        if (isset($_POST['submitted']) && $_POST['submitted'] == "提交") {
            $endtime = time();
            $handletime = $endtime - $_COOKIE['starttime'];
            $aaa=date('i:s',$handletime);
            $obj = new shudu();
            $resultstr = $_COOKIE['resultstr'];
            $resultarr = unserialize($resultstr);
            if ($obj->compareshudu($resultarr)) {
                $writeDB = new writeDB();
                $writeDB->write($aaa);
                $this->str = "恭喜通过";
            } else
                $this->str = "游戏失败";
        }
    }

    public function show()
    {
        if ( (isset($_POST['submitted']) && $_POST['submitted'] == "新建游戏")) {
            echo "<table cellspacing=\"0\" cellpadding=\"0\">";
            for ($i = 0; $i < 9; $i++) {
                echo "<tr>";
                for ($j = 0; $j < 9; $j++) {
                    if ($this->arr[$i][$j] != 0) {
                        ?>
                        <td style="border:1px solid #000000;width:30px;height:30px;text-align:center;"><?php echo $this->arr[$i][$j]; ?></td>
                        <?php
                    } else {
                        ?>
                        <td style="border:1px solid #000000;width:30px;height:30px;text-align:center;">
                            <input style="border:0px;width:30px;height:30px;text-align:center;"
                                   name="<?php echo $i * 9 + $j; ?>"/>
                        </td>
                        <?php
                    }
                }
                echo "</tr>";
            }
            echo "</table>";
            echo "<br />" . "<input type=\"submit\" name=\"submitted\" value=\"提交\" />";
        } elseif (isset($_POST['submitted']) && $_POST['submitted'] == "提交")
            echo $this->str;
    }

    public function sort()
    {
        if (isset($_POST['submitted']) && $_POST['submitted'] == "本系统排名") {
            $dbobj = new writeDB();
            $sortobj = $dbobj->get();
            $i = 0;
            foreach ($sortobj as $key => $value) {
                $i++;
                ?>
                <tr>
                    <td style="width:50px;height:30px;text-align:center;"><?php echo "第" . $i . "名" ?></td>
                    <td style="width:50px;height:30px;text-align:center;"><?php echo $value['timesort']  ?></td>
                </tr>
                <?php
            }
        } elseif (isset($_POST['submitted']) && $_POST['submitted'] == "总排名") {
            $dbobj = new writeDB();
            $sortobj = $dbobj->get();
            $i = 0;
            foreach ($sortobj as $key => $value) {
                $i++;
                ?>
                <tr>
                    <td style="width:50px;height:30px;text-align:center;"><?php echo "第" . $i . "名" ?></td>
                    <td style="width:50px;height:30px;text-align:center;"><?php echo $value['timesort']  ?></td>
                </tr>
                <?php
            }
        }
    }
}