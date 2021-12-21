<?php

//start measuring time
$time_start = microtime(true);

//connect to redis
include "../config/redis_connect.php";

// get all sorted recoreds
$play    = $redis->zRange('play',    0, -1, true);
$comment = $redis->zRange('comment', 0, -1, true);
$mylist  = $redis->zRange('mylist',  0, -1, true);
$total   = $redis->zRange('total',   0, -1, true);

// $play    = $redis->zrevRange('play',    0, 4999, true);
// $comment = $redis->zrevRange('comment', 0, 4999, true);
// $mylist  = $redis->zrevRange('mylist',  0, 4999, true);
// $total   = $redis->zrevRange('total',   0, 4999, true);

// // get top10 sorted recoreds
// $play    = $redis->zrevRange('play',    0, 9, true);
// $comment = $redis->zrevRange('comment', 0, 9, true);
// $mylist  = $redis->zrevRange('mylist',  0, 9, true);
// $total   = $redis->zrevRange('total',   0, 9, true);

$time_end = microtime(true);
//calculating time
$time = $time_end - $time_start;
echo "Time taken in seconds (read from Redis): $time";

//record time to file
//echo getcwd();
//$file = fopen("../Redis_read.txt", "a");
//file_put_contents($file, $time);
//fclose($file);

?>

<h1>play rank</h1>
<pre>
<?php
print_r($play);
?>
</pre>

<h1>comment rank</h1>
<pre>
<?php
print_r($comment);
?>
</pre>

<h1>mylist rank</h1>
<pre>
<?php
print_r($mylist);
?>
</pre>

<h1>total rank</h1>
<pre>
<?php
print_r($total);
?>
</pre>

<?php
//$time_end = microtime(true);
//$time = $time_end - $time_start;
//echo "Time taken in seconds (read from Redis): $time";
?>