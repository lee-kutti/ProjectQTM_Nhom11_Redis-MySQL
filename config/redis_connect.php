<?php
// Connect to redis
try {
    $redis = new Redis();
    $state = $redis->pconnect('127.0.0.1', 6379);
    if (!$state) {
        throw new RedisException();
        $redis = null;
        exit;
    }
} catch (RedisException $e) {
    echo "Redis Error：" . $e->getMessage();
    $redis = null;
    exit;
}
?>