<?php
include_once "TestClass.php";

/**
 * 二维数组查找
 * 在一个二维数组中（每个一维数组的长度相同），
 * 每一行都按照从左到右递增的顺序排序，每一列都按照从上到下递增的顺序排序。
 * 请完成一个函数，输入这样的一个二维数组和一个整数，判断数组中是否含有该整数。
 * @param $target
 * @param $array
 * @return bool
 */
function findMe($target, $array) {
    $count_x = null;
    if ($array && is_array($array)) {
        foreach ($array as $i => $row) {
            if (!$count_x) {
                $count_x = count($row);
            }
            if ($target > $row[$count_x - 1]) {
                continue;
            }
            if ($target < $row[0]) {
                return false;
            }
            //if(in_array($target,$row)){
            //    return true;
            //}
            //对每行使用二分查找,能比in_array高率
            $l = 0;
            $r = $count_x - 1;
            while ($l <= $r) {
                $now = intval(floor(($l + $r) / 2));
                if ($row[$now] > $target) {
                    $r = $now - 1;
                    continue;
                }
                if ($row[$now] < $target) {
                    $l = $now + 1;
                    continue;
                }
                if ($row[$now] == $target) {
                    return true;
                }

            }
        }
    }
    return false;
}


/**
 * 字符串替换
 * 将一个字符串中的每个空格替换成“%20”。
 * eg. 当字符串为We Are Happy.则经过替换之后的字符串为We%20Are%20Happy.
 * @param $str
 * @return mixed
 */
function replaceSpace($str) {
//    return str_replace(' ','%20',$str);
//    return implode("%20",explode(" ",$str));
    $tmp = '';
    $i = strlen($str) - 1;
    while ($i >= 0) {
        if ($str[$i] == ' ') {
            $tmp = '%20' . $tmp;
        } else {
            $tmp = $str[$i] . $tmp;
        }
        $i--;
    }
    return $tmp;
}


/**
 * 链表值从尾到头的顺序返回一个ArrayList。
 * @param $head ListNode
 * @return array
 */
function printListFromTailToHead($head) {
    $ar = [];
    while ($head) {
        array_unshift($ar, $head->val);
        $head = $head->next;
    }
    return $ar;
}


/**
 * 重建二叉树
 * 输入某二叉树的前序遍历和中序遍历的结果，重建出该二叉树。
 * 假设输入的前序遍历和中序遍历的结果中都不含重复的数字。
 * 例如输入前序遍历序列{1,2,4,7,3,5,6,8}和中序遍历序列{4,7,2,1,5,3,8,6}，则重建二叉树并返回。
 * @param $pre array 前序遍历结果
 * @param $vin array 中序遍历结果
 * @return TreeNode 二叉树的根节点
 */
function reConstructBinaryTree($pre, $vin) {
    if ($pre && $pre == $vin) {
        $tmp = $root = new TreeNode(null);
        foreach ($pre as $one) {
            $tmp->right = new TreeNode($one);
            $tmp = $tmp->right;
        }
        return $root->right;
    }
    $root = new TreeNode($pre[0]);

    $idx = array_search($pre[0], $vin);
    if ($idx > 0) {
        $root->left = reConstructBinaryTree(array_slice($pre, 1, $idx, false), array_slice($vin, 0, $idx, false));
    }

    if ($idx < count($vin) - 1) {
        $root->right = reConstructBinaryTree(array_slice($pre, $idx + 1, null, false), array_slice($vin, $idx + 1, null, false));
    }
    return $root;
}

//print_r(reConstructBinaryTree([1, 2, 4, 7, 3, 5, 6, 8], [4, 7, 2, 1, 5, 3, 8, 6]));


/**
 * 旋转数组的最小数字
 * 把一个数组最开始的若干个元素搬到数组的末尾，我们称之为数组的旋转。
 * 输入一个非减排序的数组的一个旋转，输出旋转数组的最小元素。
 * 例如数组{3,4,5,1,2}为{1,2,3,4,5}的一个旋转，该数组的最小值为1。
 * NOTE：给出的所有元素都大于0，若数组大小为0，请返回0。
 * @param $rotateArray
 * @return int
 */
function minNumberInRotateArray($rotateArray) {
    if (empty($rotateArray) || !is_array($rotateArray)) {
        return 0;
    }
    $high = count($rotateArray) - 1;
    if ($rotateArray[0] <= $rotateArray[$high]) {
        return $rotateArray[0];
    }
    $low = 0;
    while ($low <= $high) {
        if ($low == $high) {
            return $rotateArray[$low];
        }
        $mid = intval(($low + $high) / 2);
        if ($rotateArray[0] > $rotateArray[$mid]) {
            if ($rotateArray[$mid] < $rotateArray[$mid - 1]) {
                return $rotateArray[$mid];
            }
            $high = $mid - 1;
        } else {
            $low = $mid + 1;
        }

    }
}

/**
 * 斐波那契数列
 * 现在要求输入一个整数n，输出斐波那契数列的第n项（从0开始，第0项为0）
 * @param $n
 * @return int
 */
function Fibonacci($n) {
    if ($n < 2) {
        return $n;
    }
    $f1 = 0;
    $f2 = $f3 = 1;
    for ($i = 2; $i <= $n; $i++) {
        $f3 = $f1 + $f2;
        $f1 = $f2;
        $f2 = $f3;
    }
    return $f3;
}

/**
 * 跳台阶
 * 一只青蛙一次可以跳上1级台阶，也可以跳上2级。求该青蛙跳上一个n级的台阶总共有多少种跳法（先后次序不同算不同的结果）。
 * @param $number
 * @return int
 */
function jumpFloor($number) {
    if ($number <= 0) {
        return 0;
    } elseif ($number <= 2) {
        return $number;
    }
    $f1 = $f2 = $f3 = 1;
    for ($i = 2; $i <= $number; $i++) {
        $f3 = $f1 + $f2;
        $f1 = $f2;
        $f2 = $f3;
    }
    return $f3;
}


/**
 * 变态跳台阶
 * 一只青蛙一次可以跳上1级台阶，也可以跳上2级……它也可以跳上n级。求该青蛙跳上一个n级的台阶总共有多少种跳法。
 * @param $number
 * @return int
 */
function jumpFloorII($number) {
    if ($number <= 0) {
        return 0;
    }
    return $number == 1 ? 1 : 1 << ($number - 1);
}

/**
 * 矩形覆盖
 * 我们可以用2*1的小矩形横着或者竖着去覆盖更大的矩形。请问用n个2*1的小矩形无重叠地覆盖一个2*n的大矩形，总共有多少种方法？
 * @param $number int
 * @return int
 */
function rectCover($number) {
    //f(n) = f(n-1)+f(n-2)

    if ($number <= 0) {
        return 0;
    } elseif ($number == 1 || $number == 2) {
        return $number;
    } else {
        $f1 = 1;
        $f2 = 2;
        $result = 0;
        for ($i = 3; $i <= $number; $i++) {
            $result = $f1 + $f2;
            $f1 = $f2;
            $f2 = $result;
        }
        return $result;
    }
}

/**
 * 二进制中1的个数
 * 输入一个整数，输出该数二进制表示中1的个数。其中负数用补码表示
 * @param $n
 * @return int
 */
function NumberOf1($n) {
    $count = 0;
    $n = $n & 0xffffffff;
    while ($n) {
        $count++;
        $n = ($n - 1) & $n;
    }
    return $count;
}

/**
 * 数值的整数次方
 * 给定一个double类型的浮点数base和int类型的整数exponent。求base的exponent次方。
 * @param $base double
 * @param $exponent int
 * @return double
 */
function Power($base, $exponent) {
    if (!$base) return 0;
    if ($base == 1 || $exponent == 1) return $base;
    $result = 1;//0直接返回1
    $is_f = false;
    if ($exponent < 0) {
        $is_f = true;//负数求倒数
        $exponent = -$exponent;
    }
    while ($exponent) {
        if ($exponent & 1) {//&1 判断最后一位是否为1
            $result *= $base;
        }
        $base *= $base;
        $exponent >>= 1;
    }
    return $is_f ? 1 / $result : $result;
}

/**
 * 调整数组顺序使奇数位于偶数前面
 * 输入一个整数数组，实现一个函数来调整该数组中数字的顺序，
 * 使得所有的奇数位于数组的前半部分，所有的偶数位于数组的后半部分，并保证奇数和奇数，偶数和偶数之间的相对位置不变。
 * @param $array
 * @return array
 */
function reOrderArray($array) {

    $res = [[], []];
    foreach ($array as $one) {
        if ($one & 1) {
            //奇数
            $res[0][] = $one;
        } else {
            $res[1][] = $one;
        }
    }
    return array_merge($res[0], $res[1]);
}


/**
 * 链表中倒数第k个结点
 * @param $head ListNode
 * @param $k int
 * @return ListNode|false
 */
function FindKthToTail($head, $k) {
    if ($k <= 0) {
        return false;
    }
    $end = $head;
    $kNode = null;
    while ($end) {
        if ($k > 0) {
            $k--;
        }
        if ($k == 0) {
            $kNode = $kNode ? $kNode->next : $head;
        }
        $end = $end->next;
    }
    if ($k > 0) {
        return false;
    }
    return $kNode;
}

/**
 * 反转链表
 * 输入一个链表，反转链表后，输出新链表的表头。
 * @param $pHead ListNode
 * @return ListNode
 */
function ReverseList($pHead) {
    $last = null;
    while ($pHead) {
        $tmp = $pHead->next;
        $pHead->next = $last;
        $last = $pHead;

        if ($tmp) {
            $pHead = $tmp;
        } else {
            break;
        }
    }
    return $pHead;
}

/**
 * 合并两个排序的链表
 * 输入两个单调递增的链表，输出两个链表合成后的链表，合成后的链表满足单调不减规则。
 * @param $pHead1 ListNode
 * @param $pHead2 ListNode
 * @return ListNode
 */
function Merge($pHead1, $pHead2) {
    if (!$pHead1) {
        return $pHead2 ?: null;
    }
    if (!$pHead2) {
        return $pHead1 ?: null;
    }

    if ($pHead1->val <= $pHead2->val) {
        $head = $bef = $pHead1;
        $pHead1 = $pHead1->next;
    } else {
        $head = $bef = $pHead2;
        $pHead2 = $pHead2->next;
    }
    while ($pHead1 && $pHead2) {
        if ($pHead1->val <= $pHead2->val) {
            $bef->next = $pHead1;
            $bef = $pHead1;
            $pHead1 = $pHead1->next;
        } else {
            $bef->next = $pHead2;
            $bef = $pHead2;
            $pHead2 = $pHead2->next;
        }
    }
    if ($pHead1) {
        $bef->next = $pHead1;
    } elseif ($pHead2) {
        $bef->next = $pHead2;
    }
    return $head;
}


/**
 * 树的子结构
 * 输入两棵二叉树A，B，判断B是不是A的子结构。空树不是任意一个树的子结构。
 * @param $root1 TreeNode
 * @param $root2 TreeNode
 * @return bool
 */
function HasSubtree($root1, $root2) {
    if (!$root1 || !$root2) {
        return false;
    }
    $find = [];
    $is_find = findValFromTree($root1, $root2->val, $find);
    if ($is_find && count($find) > 0) {
        foreach ($find as $node){
            if(checkSubTree($node,$root2)){
                return true;
            }
        }
    }
    return false;
}

/**
 * 二叉树查找
 * @param $root TreeNode 待查找的树
 * @param $val mixed 要查找的值
 * @param $find array 查找到的结果
 * @return bool
 */
function findValFromTree($root, $val, &$find) {
    if (!$root) {
        return false;
    }
    if ($root->val == $val) {
        $find[] = $root;
    }
    if ($root->left) {
        findValFromTree($root->left, $val, $find);
    }
    if ($root->right) {
        findValFromTree($root->right, $val, $find);
    }
    return true;
}

/**
 * 检查树1包含树2
 * @param $root1 TreeNode
 * @param $root2 TreeNode
 * @return bool
 */
function checkSubTree($root1,$root2){
    $flag = true;
    if(!$root1&&!$root2){
        return true;
    }
    if((!$root1&&$root2) || ($root1&&!$root2)){
        return false;
    }
    if($root1->val != $root2->val){
        return false;
    }
    if($root2->left){
        $flag = checkSubTree($root1->left,$root2->left);
    }
    if($flag && $root2->right){
        $flag = checkSubTree($root1->right,$root2->right);
    }
    return $flag;
}

/**
 * 二叉树的镜像
 * @param $root TreeNode
 */
function Mirror(&$root)
{
    if(!$root){
        return;
    }
    if($root->left || $root->right){
        $tmp = $root->left;
        $root->left = $root->right;
        $root->right = $tmp;
        unset($tmp);
    }
    if($root->left){
        Mirror($root->left);
    }
    if($root->right){
        Mirror($root->right);
    }
}