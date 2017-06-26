<?php
require_once 'connDB.php';
/**
 * Created by PhpStorm.
 * User: jinzil
 * Date: 2015/12/23
 * Time: 21:01
 */
class writeDB
{
     function write($time)    //将4个整数和所有解写进数据库
    {
        $sql="INSERT INTO shudu(timesort) VALUES ('$time')";
        if(!mysql_query($sql))  //因为first_num,second_num,third_num,fouth_num四个数构成主码，所以存在重复插入失败的情况，所以不再进行插入
            echo "保存数据库失败";
    }
    function get(){
        $sqlget="SELECT * FROM shudu ORDER BY(timesort) ASC";
        return $this->select($sqlget);
    }
    function select($sql = "")
    {
        $result = mysql_query($sql);
        if ((!$result) or (empty($result))) {
            @mysql_free_result($result);
            return false;
        }
        $count=0;
        $data=array();
        while($row=mysql_fetch_array($result)){
            $data[$count]=$row;
            $count++;
        }
        @mysql_free_result($result);
        return $data;
    }
}