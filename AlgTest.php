<?php

/**
 * 基础算法
 */
class AlgTest
{

    /**
     * 堆排序
     * 构建大顶堆，然后将堆顶元素与未排序队列的最后一位互换
     * 之后未排序队列继续循环构建大顶堆
     * 时间复杂度 O(nlgn)
     * @access  public
     * @param array $arr 待排序数组
     * @return  boolean 是否成功
     * @var     integer $last 未排序队列最后一个元素的下标
     */
    public function heapSort(array &$arr)
    {
        //检查数组
        if (!$this->checkArr($arr)) {
            return false;
        }
        //判断数组长度
        if (count($arr) == 1) {
            return true;
        }

        $last = count($arr) - 1;
        for (; $last > 0; $last--) {
            $this->sortNodeIter($arr, $last);
            $this->swap($arr[0], $arr[$last]);
        }
        return true;
    }

    /**
     * 把数组下标小于$last的元素构建成大顶堆
     * @param array $arr 待排序数组
     * @param integer $last 未排序队列最后一个元素的下标
     * @var   integer $idx 当前要比较的节点，即最后一个未入堆的非叶子节点下标
     */
    private function sortNodeIter(array &$arr, $last)
    {
        $idx = floor(($last + 1) / 2) - 1;
        for (; $idx >= 0; $idx--) {
            $max_idx = $idx;
            $l_idx = $idx * 2 + 1;
            if ($l_idx <= $last) {
                $max_idx = $arr[$l_idx] > $arr[$max_idx] ? $l_idx : $max_idx;
                if ($l_idx + 1 <= $last) {
                    $max_idx = $arr[$l_idx + 1] > $arr[$max_idx] ? $l_idx + 1 : $max_idx;
                }
            }
            if ($max_idx != $idx) {
                $this->swap($arr[$max_idx], $arr[$idx]);
            }
        }
    }

    /**
     * 以递归的方式把数组下标小于$last的元素位构建成大顶堆。只适合少量数据时
     * @param array $arr 待排序数组
     * @param integer $last 未排序队列最后一个元素的下标
     * @param integer $idx 当前要比较的节点，即最后一个未入堆的非叶子节点下标
     */
    private function sortNodeRec(array &$arr, $last, $idx = -1)
    {
        if ($idx < 0)
            $idx = floor(($last + 1) / 2) - 1;
        $max_idx = $idx;
        $l_idx = $idx * 2 + 1;
        if ($l_idx <= $last) {
            $max_idx = $arr[$l_idx] > $arr[$max_idx] ? $l_idx : $max_idx;
            if ($l_idx + 1 <= $last) {
                $max_idx = $arr[$l_idx + 1] > $arr[$max_idx] ? $l_idx + 1 : $max_idx;
            }
        }
        if ($max_idx != $idx) {
            $this->swap($arr[$max_idx], $arr[$idx]);
        }
        if ($idx > 0) {
            $this->sortNodeRec($arr, $last, $idx - 1);
        }
    }

    /**
     * 冒泡排序
     * 从前往后循环n-1次，第i次循环就将前n-i个元素中最大的放在第n-i位
     * 最好情况排序好的队列O(n)
     * 最差情况排序相反的队列O(n^2)
     * @param array $arr
     * @return bool
     */
    public function bubbleSort(array &$arr)
    {
        //检查数组
        if (!$this->checkArr($arr)) {
            return false;
        }
        //判断数组长度
        if (count($arr) == 1) {
            return true;
        }
        $last = count($arr) - 1;
        for ($i = 0; $i < count($arr) - 1; $i++, $last--) {
            for ($j = 0; $j < $last; $j++) {
                if ($arr[$j] > $arr[$j + 1]) {
                    $this->swap($arr[$j], $arr[$j + 1]);
                }
            }
        }
        return true;
    }

    /**
     * 快速排序
     * 迭代使用栈
     * 最优的情况每一次取到的元素都刚好平分整个数组 O(nlogn)
     * 最差每次取的Mark值都是当前队列最值 O(n^2)
     * @param array $arr
     * @return bool
     */
    public function quickSort(array &$arr)
    {
        //检查数组
        if (!$this->checkArr($arr)) {
            return false;
        }
        //判断数组长度
        if (count($arr) == 1) {
            return true;
        }
        $stack = array($arr);
        $arr = array();

        //栈空即跳出循环
        while ($stack) {
            //$current_arr指当前需要划分的子数组,入栈时从大到小，出栈时由小到大
            $current_arr = array_pop($stack);
            if (count($current_arr) <= 1) {
                $arr[] = &$current_arr[0];
                continue;
            }
            $mark = $current_arr[0];
            $big = array();
            $small = array();

            //用两个数组分别接受比$mark小和比$mark大的数据
            for ($i = 1; $i < count($current_arr); $i++) {
                if ($current_arr[$i] <= $mark) {
                    array_push($small, $current_arr[$i]);
                } else {
                    array_push($big, $current_arr[$i]);
                }
            }

            //入栈，从大到小，以便出栈时由小到大
            if (!empty($big)) {
                array_push($stack, $big);
            }
            array_push($stack, array($current_arr[0]));

            if (!empty($small)) {
                array_push($stack, $small);
            }
        }
        return true;
    }

    /**
     * 快速排序
     * 使用递归,容易溢出调用栈
     * @param array $arr
     * @return bool
     */
    public function quickSortRec(array &$arr)
    {
        //检查数组
        if (!$this->checkArr($arr)) {
            return false;
        }
        //判断数组长度
        if (count($arr) == 1) {
            return true;
        }
        $this->quickRec($arr, 0, count($arr) - 1);
        return true;
    }

    //递归快排
    private function quickRec(&$arr, $left, $right)
    {
        if ($left >= $right) return;
        $temp = $arr[$left];
        $i = $left;
        $j = $right;
        while ($i < $j) {
            while ($i < $j && $arr[$j] > $temp) {
                $j--;
            }
            while ($i < $j && $arr[$i] <= $temp) {
                $i++;
            }
            if ($i < $j) {
                $this->swap($arr[$i], $arr[$j]);
            }

        }
        if ($left < $i) {
            $this->swap($arr[$left], $arr[$i]);
        }
        $this->quickRec($arr, $left, $i - 1);
        $this->quickRec($arr, $i + 1, $right);
        return;
    }


    //交换两个变量的值
    private function swap(&$a, &$b)
    {
        //当ab相等时为0
        if ($a == $b) return;
        $a ^= $b ^= $a ^= $b;
    }

    //检查数组
    private function checkArr(array $arr)
    {
        if (!$arr || !is_array($arr)) {
            return false;
        }
        return true;
    }

    //展示排序功能
    public function showSort($count = 100)
    {
        //设置网页不超时 防止排序时间过长
        set_time_limit(100);
        //生成数组，随机排序
        $arr = range(1, $count);

        $this->activeSort($arr, "bubbleSort");
        $this->activeSort($arr, "heapSort");
        $this->activeSort($arr, "quickSort");
        $this->activeSort($arr, "quickSortRec");
    }

    private function activeSort(array &$arr, $do = "bubbleSort", $parameter = null)
    {
        if (!method_exists($this, $do))
            exit("不存在方法 $do" . PHP_EOL);
        shuffle($arr);
        echo "-----$do-----\n    排序前：" . implode(',', $arr) . PHP_EOL;
        $t = -microtime(true);
        if ($parameter ? !$this->$do($arr, $parameter) : !$this->$do($arr)) {
            exit( "$do 出错skrskrskr！！！" . PHP_EOL);
        }
        $t = round(($t + microtime(true)) * 1000, 2);
        echo "    排序后：" . implode(',', $arr) . PHP_EOL;
        echo "-----$do 用时 $t ms ------" . PHP_EOL;
    }
}