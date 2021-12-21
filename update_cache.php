<?php
// 0 7,9,13,15 * * 1,2,3,4,5 php -f /home/leekutti/Projects/update_cache.php

// Connect to database
$conn = mysqli_connect('localhost', 'test_user', 'Password@123', 'ProjectQTM');

// Check connection
if (!$conn) {
  echo "Connection error: " . mysqli_connect_error();
}

// Connect to redis
try {
    $redis = new Redis();
    $state = $redis->connect('127.0.0.1', 6379);
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

$sql = "SELECT * FROM patients";
$result = mysqli_query($conn, $sql);

if ($result)
{
  while ($row = $result -> fetch_row()) {
    $id = $row[0];
    $value = $row[1] . "@@@@" . $row[2] . "@@@@" . $row[3] . "@@@@" . $row[4] . "@@@@" . $row[5] . "@@@@" . $row[6] . "@@@@" . $row[7];
    $redis->set($id, $value);
    $redis->expire($id, 1200);
  }
}

mysqli_close($conn);

?>
