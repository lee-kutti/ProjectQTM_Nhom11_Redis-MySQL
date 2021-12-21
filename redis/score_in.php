<?php

//$FILE = "./test_data.csv";
$FILE = "./test_data_large.csv";

//start measuring time
$time_start = microtime(true);

//connect to redis
include "../config/redis_connect.php";

$redis->flushAll();
$file = fopen($FILE, "r");
while ($data = fgetcsv($file)) {
	$redis->zadd("play",    $data[0], $data[3]);
	$redis->zadd("comment", $data[1], $data[3]);
	$redis->zadd("mylist",  $data[2], $data[3]);
	$redis->zadd("total",   $data[0] + ($data[1] * 10) + ($data[2] * 100), $data[3]);
}

$time_end = microtime(true);
//calculating time
$time = $time_end - $time_start;
echo "Time taken in seconds (flush all keys and write to Redis): $time";

fclose($file);

//record time to file
//$file = fopen("../Redis_write.txt", "a");
//file_put_contents($file, $time);
//fclose($file);

// $play    = $redis->zRange('play',    0, -1, true);
// $comment = $redis->zRange('comment', 0, -1, true);
// $mylist  = $redis->zRange('mylist',  0, -1, true);
// $total   = $redis->zRange('total',   0, -1, true);
//}
?>

<pre>
<?php
// print_r($play);
// print_r($comment);
// print_r($mylist);
// print_r($total);
?>
</pre>

<?php
//$time_end = microtime(true);
//$time = $time_end - $time_start;
//echo "Time taken in seconds (write to Redis): $time";
?>