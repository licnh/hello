<?php
require_once "./offer/one.php";

echo "start:" . PHP_EOL;
$res = null;

$start_time = microtime();

//$res = findMe(15, [[1, 2, 8, 9], [2, 4, 9, 12], [4, 7, 10, 13], [6, 8, 11, 15]]);
//$res = replaceSpace('We Are Happy');
//$res = printListFromTailToHead($head);
//$res = reConstructBinaryTree([1, 2, 4, 7, 3, 5, 6, 8], [4, 7, 2, 1, 5, 3, 8, 6]);
//$res = minNumberInRotateArray([5, 6, 7, 1, 2, 3, 4,]);
//$res = Fibonacci(9);
//$res = jumpFloor(9);
//$res = jumpFloorII(0);
//$res = rectCover(5);
//$res = NumberOf1(-27483648);
//$res = Power(2,-4);
//$res = reOrderArray([5, 6, 7, 1, 2, 3, 4,]);
//$res = Merge(new ListNode());
//$res = printMatrix([[1,2,3,4],[5,6,7,8],[9,10,11,12]]);
//$res = IsPopOrder([1,2,3,4,5],[4,3,5,2,1]);
//$res = VerifySquenceOfBST([3,1,2,6,7,9,8,4]);
//$res = FindPath($n3,15);
//$res = MyClone($random_node1);
//$res = Convert($n5,$start,$end);
$res = Permutation('aba');
$end_time = microtime();

//计算毫秒
$start_time = explode(" ", $start_time);
$end_time = explode(" ", $end_time);

$start_time = floatval(substr($start_time[1], -3) . substr($start_time[0], 0, 8));
$end_time = floatval(substr($end_time[1], -3) . substr($end_time[0], 0, 8));

$cost = round(($end_time - $start_time) * 1000, 3);

echo "res:" . PHP_EOL;
print_r($res);
echo PHP_EOL . "----------------------";
echo PHP_EOL . "cost_time:\t $cost 毫秒";
echo PHP_EOL . "<<<<<<<<<<<<<<<<<<<<<<";