<?php

// rank data
$play    = array();
$comment = array();
$mylist  = array();
$total   = array();

// choose sql
$select1 = "SELECT * FROM play    ORDER BY score desc";
$select2 = "SELECT * FROM comment ORDER BY score desc";
$select3 = "SELECT * FROM mylist  ORDER BY score desc";
$select4 = "SELECT * FROM total   ORDER BY score desc";

// $select1 = "SELECT * FROM play    ORDER BY score desc LIMIT 5000";
// $select2 = "SELECT * FROM comment ORDER BY score desc LIMIT 5000";
// $select3 = "SELECT * FROM mylist  ORDER BY score desc LIMIT 5000";
// $select4 = "SELECT * FROM total   ORDER BY score desc LIMIT 5000";

// $select1 = "SELECT * FROM play    ORDER BY score desc LIMIT 10";
// $select2 = "SELECT * FROM comment ORDER BY score desc LIMIT 10";
// $select3 = "SELECT * FROM mylist  ORDER BY score desc LIMIT 10";
// $select4 = "SELECT * FROM total   ORDER BY score desc LIMIT 10";

//start measuring time
$time_start = microtime(true);

// db connection
require "../config/db_connect.php";
mysqli_set_charset($conn, "utf8");

// go query
$result1 = mysqli_query($conn, $select1);
$result2 = mysqli_query($conn, $select2);
$result3 = mysqli_query($conn, $select3);
$result4 = mysqli_query($conn, $select4);

while ($row = mysqli_fetch_assoc($result1)) {
	$play[$row["name"]]    = $row["score"];
}
while ($row = mysqli_fetch_assoc($result2)) {
	$comment[$row["name"]] = $row["score"];
}
while ($row = mysqli_fetch_assoc($result3)) {
	$mylist[$row["name"]]  = $row["score"];
}
while ($row = mysqli_fetch_assoc($result4)) {
	$total[$row["name"]]   = $row["score"];
}

$time_end = microtime(true);
//calculating time
$time = $time_end - $time_start;
echo "Time taken in seconds (read from MySQL): $time";

//record time to file
//$file = fopen("../MySQL_read.txt", "a");
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
//echo "Time taken in seconds (read from MySQL): $time";
?>