<?php
/**
 * 二维数组查找
 * 在一个二维数组中（每个一维数组的长度相同），
 * 每一行都按照从左到右递增的顺序排序，每一列都按照从上到下递增的顺序排序。
 * 请完成一个函数，输入这样的一个二维数组和一个整数，判断数组中是否含有该整数。
 * @param $target
 * @param $array
 * @return bool
 */
function findMe($target, $array)
{
    $count_x = null;
    if($array && is_array($array)){
        foreach ($array as $i=>$row){
            if(!$count_x){
                $count_x = count($row);
            }
            if($target>$row[$count_x-1]){
                continue;
            }
            if($target<$row[0]){
                return false;
            }
            //if(in_array($target,$row)){
            //    return true;
            //}
            //对每行使用二分查找,能比in_array高率
            $l = 0;
            $r = $count_x-1;
            while($l<=$r){
                $now = intval(floor(($l+$r)/2));
                if($row[$now]>$target){
                    $r = $now-1;
                    continue;
                }
                if($row[$now]<$target){
                    $l = $now+1;
                    continue;
                }
                if($row[$now]==$target){
                    return true;
                }

            }
        }
    }
    return false;
}
//echo "start:";
//echo findMe(15,[[1,2,8,9],[2,4,9,12],[4,7,10,13],[6,8,11,15]])?'true':'false';



/**
 * 字符串替换
 * 将一个字符串中的每个空格替换成“%20”。
 * eg. 当字符串为We Are Happy.则经过替换之后的字符串为We%20Are%20Happy.
 * @param $str
 * @return mixed
 */
function replaceSpace($str)
{
//    return str_replace(' ','%20',$str);
//    return implode("%20",explode(" ",$str));
    $tmp = '';
    $i=strlen($str)-1;
    while ($i>=0){
        if($str[$i]==' '){
            $tmp = '%20' . $tmp;
        }else{
            $tmp = $str[$i] . $tmp;
        }
        $i--;
    }
    return $tmp;
}
//echo "start \n";
//print_r(replaceSpace('We Are Happy'));


/**
 *
 * 链表值从尾到头的顺序返回一个ArrayList。
 * @param $head {
            var $val;
            var $next = NULL;
            function __construct($x){
            $this->val = $x;
        }
 * @return array
 */
function printListFromTailToHead($head)
{
    $ar = [];
    getVal($head,$ar);
    return $ar;
}

function getVal($node,&$ar){
    if($node->next){
        getVal($node->next,$ar);
    }
    $ar[] = $node->val;
}