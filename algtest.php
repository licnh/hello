<?php

/**
 * 基础算法
 */
class AlgTest{

    /**
     * 堆排序
     * 构建大顶堆，然后将堆顶元素与未排序队列的最后一位互换
     * 之后未排序队列继续循环构建大顶堆
     * 时间复杂度 O(nlgn)
     * @access  public
     * @param   array $arr 待排序数组
     * @var     integer $last 未排序队列最后一个元素的下标
     * @return  boolean 是否成功
     */
    public function heapSort(array &$arr){
        if (!$arr){
            return false;
        } elseif (count($arr) == 1){
            return true;
        }

        $last = count($arr) - 1;
        for(; $last>0; $last--){
            $this->sortNode($arr, $last);
            $this->swap($arr[0],$arr[$last]);
        }
        return true;
    }

    /**
     * 把数组下标小于$last的元素构建成大顶堆
     * @param array $arr 待排序数组
     * @param integer $last 未排序队列最后一个元素的下标
     * @var   integer $idx 当前要比较的节点，即最后一个未入堆的非叶子节点下标
     */
    private function sortNode(array &$arr, $last){
        $idx = floor(($last + 1) / 2) - 1;
        for (; $idx >= 0; $idx--) {
            $max_idx = $idx;
            $l_idx = $idx * 2 + 1;
            if($l_idx <= $last){
                $max_idx = $arr[$l_idx] > $arr[$max_idx] ? $l_idx : $max_idx;
                if($l_idx + 1 <= $last){
                    $max_idx = $arr[$l_idx+1] > $arr[$max_idx] ? $l_idx + 1 : $max_idx;
                }
            }
            if($max_idx != $idx){
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
    private function sortNodeByDiGui(array &$arr, $last, $idx = -1){
        if($idx < 0)
            $idx = floor(($last + 1) / 2) - 1;
        $max_idx = $idx;
        $l_idx = $idx*2+1;
        if($l_idx <= $last){
            $max_idx = $arr[$l_idx] > $arr[$max_idx] ? $l_idx : $max_idx;
            if($l_idx+1 <= $last){
                $max_idx = $arr[$l_idx+1] > $arr[$max_idx] ? $l_idx+1 : $max_idx;
            }
        }
        if($max_idx != $idx){
            $this->swap($arr[$max_idx], $arr[$idx]);
        }
        if($idx>0){
            $this->sortNodeByDiGui($arr, $last, $idx-1);
        }
    }

    /**
     * 冒泡排序
     * 从前往后循环n-1次，第i次循环就将前n-i个元素中最大的放在第n-i位
     * @param array $arr
     * @return bool
     */
    public function bubbleSort(array &$arr){
        if (!$arr){
            return false;
        } elseif (count($arr) == 1){
            return true;
        }
        $last = count($arr) - 1;
        for ($i = 0; $i < count($arr) - 1; $i++, $last--){
            for($j= 0; $j < $last; $j++){
                if($arr[$j] > $arr[$j+1]){
                    $this->swap($arr[$j], $arr[$j+1]);
                }
            }
        }
        return true;
    }

    //交换两个变量的值
    private function swap(&$a, &$b){
        $a ^= $b ^= $a ^= $b;
    }

    //展示排序功能
    public function showSort($count = 100){
        //设置网页不超时 防止排序时间过长
        set_time_limit(0);
        //生成数组，随机排序
        $arr = range(1,$count);
        shuffle($arr);

//        echo "排序前：".implode(", ", $arr)."<br>";

        $this->activeSort($arr,"bubbleSort");
        $this->activeSort($arr,"heapSort");

//        echo "排序后：".implode(", ", $arr)."<br>";
    }

    private function activeSort(array &$arr, $do = "bubbleSort"){
        if(!method_exists($this, $do))
            exit("<hr>不存在方法 $do");
        $t = -microtime(true);
        if(!$this->$do($arr)){
            exit("<hr>$do 出错skrskrskr！！！");
        }
        $t = round($t + microtime(true), 4);
        echo "$do 用时 $t s 平均：".$t/count($arr)."<br>";
    }
}


(new AlgTest())->showSort();
