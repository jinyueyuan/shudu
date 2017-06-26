<?php
/**
 * Created by PhpStorm.
 * User: jinzil
 * Date: 2016/1/1
 * Time: 23:49
 */
class shudu
{

    /**
     *<p>打印二维数组，数独矩阵 </p>
     */
    private $seedArray;
    public function printArray($a)
    {
        for ($i = 0; $i < 9; $i++) {
            for ($j = 0; $j < 9; $j++) {
                echo " " . $a[$i][$j];
                if (0 == (($j + 1) % 3)) {
                    echo "&nbsp";;
                }
            }
            echo "<br />";
            if (0 == (($i + 1) % 3)) {
                echo "<br />";
            }
        }
    }

    public function creatNineRondomArray()
    {
        $arr = array(1, 2, 3, 4, 5, 6, 7, 8, 9);
        shuffle($arr);
//        echo("生成的一维数组为：");
//        for($i=0;$i<9;$i++)
//            echo " ".$arr[$i];
//        echo "<br /><br />";
        return $arr;
    }

    /**
     *<p>通过一维数组和原数组生成随机的数独矩阵</p>
     *<p>
     *遍历二维数组里的数据，在一维数组找到当前值的位置，并把一维数组
     *当前位置加一处位置的值赋到当前二维数组中。目的就是将一维数组为
     *依据，按照随机产生的顺序，将这个9个数据进行循环交换，生成一个随
     *机的数独矩阵。
     *</p>
     */
    public function creatSudokuArray($seedArray, $randomList)
    {
        for ($i = 0; $i < 9; $i++) {
            for ($j = 0; $j < 9; $j++) {
                for ($k = 0; $k < 9; $k++) {
                    if ($seedArray[$i][$j] == $randomList[$k]) {
                        $seedArray[$i][$j] = $randomList[($k+1)%9];
                        break;
                    }
                }
            }
        }
        echo "处理后的数组:"."<br />";
        $this->printArray($seedArray);
        return $seedArray;
    }
    public function select(){
        $arr=array();
        for ($i = 0; $i < 9; $i++) {
            $ramarr = array(1, 2, 3, 4, 5, 6, 7, 8, 9);
            $randomList=array_rand($ramarr,7);
            for ($j = 0; $j < 9; $j++) {
                $flag=0;
                for ($k = 0; $k < 7; $k++) {
                    if ($j == $randomList[$k]) {
                        $arr[$i][$j] = $this->seedArray[$i][$j];
                        break;
                    }
                    if($k==6)
                        $flag=1;
                }
                if($flag==1)
                  $arr[$i][$j]=0;
            }
        }
//        $this->printArray($arr);
        return $arr;
    }
    //
    public function compareshudu( $resultarr){
        for($i=0;$i<9;$i++) {
            for ($j = 0; $j < 9; $j++) {
                $k = $i * 9 + $j;
                if (isset($_POST[$k])) {
                    if ($_POST[$k] != $resultarr[$i][$j])
                        return false;
                }
            }
        }
        return true;
    }

    public function main()
    {
        $arr1 = array(8, 3, 7, 4, 6, 1, 5, 2, 9);
        $arr2 = array(5, 4, 1, 9, 2, 8, 7, 3, 6);
        $arr3 = array(2, 6, 9, 5, 3, 7, 4, 1, 8);
        $arr4 = array(9, 5, 4, 6, 8, 3, 2, 7, 1);
        $arr5 = array(7, 2, 8, 1, 9, 5, 3, 6, 4);
        $arr6 = array(3, 1, 6, 7, 4, 2, 8, 9, 5);
        $arr7 = array(4, 7, 5, 3, 1, 9, 6, 8, 2);
        $arr8 = array(1, 8, 3, 2, 5, 6, 9, 4, 7);
        $arr9 = array(6, 9, 2, 8, 7, 4, 1, 5, 3);
        $seedArray = array("0" => $arr1, "1" => $arr2, "2" => $arr3, "3" => $arr4, "4" => $arr5, "5" => $arr6, "6" => $arr7, "7" => $arr8, "8" => $arr9);
//        echo "原始的二维数组:"."<br />";
//        $this->printArray($seedArray);
        $randomList = $this->creatNineRondomArray();
        $resultaray=$this->creatSudokuArray($seedArray, $randomList);
        $this->seedArray=$resultaray;
        return $resultaray;
    }
}