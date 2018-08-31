<?php
//Redis锁
$lock = 'lock_test';    //设置锁KEY
$lock_expire = 5;       //设置锁的有效期为5秒

$count = 5;     //重试次数


assert($redis); //假装连了redis   <(ˉ^ˉ)>

$status = true;
while ($status && $count > 0) {

    //设置锁值, 为当前时间戳 + 有效期
    $lock_to = time() + $lock_expire;
    //setnx，不存在锁就直接生成锁
    $is_set = $redis->setnx($lock, $lock_to);

    //创建锁成功 $is_set != 0
    //锁值是小于当前时间即已经过期的锁 get($lock) < time()
    //锁设置新锁时限时返回的旧时限小于当前时间，大于当前时间说明有别的进程在用锁 getSet() < time()
    if($is_set != 0 || ($redis->get($lock) < time() && $redis->getSet($lock, $lock_to) < time())) {
        //给锁设置生存时间
        $redis->expire($lock, $lock_expire);
        //业务处理
        //$redis->set("test", time());
        //sleep(2);

        //如果锁过期就不能删除，可能有别的进程在用锁
        if($redis->ttl($lock))
            $redis->del($lock);
        $status = false;
    }else{
        //等待次数递减, 2秒后再尝试执行操作
        $count--;
        sleep(2);
    }
}

//限定的重复次数中未能占用锁
if($status){
    echo "可怜！ (｡ŏ_ŏ)";
}