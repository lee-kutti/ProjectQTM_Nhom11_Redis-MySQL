<?php

//$FILE = "./test_data.csv";
$FILE = "./test_data_large.csv";

// reset tables
$reset1 = "truncate play;";
$reset2 = "truncate comment;";
$reset3 = "truncate mylist;";
$reset4 = "truncate total;";

//start measuring time
$time_start = microtime(true);

//database connect
require "../config/db_connect.php";
mysqli_set_charset($conn, "utf8");

mysqli_query($conn, $reset1);
mysqli_query($conn, $reset2);
mysqli_query($conn, $reset3);
mysqli_query($conn, $reset4);

// insert data
$file = fopen($FILE, "r");
while ($data = fgetcsv($file)) {
	$total = $data[0] + ($data[1] * 10) + ($data[2] * 100);
	$insert1 = "insert into play    values('{$data[3]}', {$data[0]});";
	$insert2 = "insert into comment values('{$data[3]}', {$data[1]});";
	$insert3 = "insert into mylist  values('{$data[3]}', {$data[2]});";
	$insert4 = "insert into total   values('{$data[3]}', {$total});";
	mysqli_query($conn, $insert1);
	mysqli_query($conn, $insert2);
	mysqli_query($conn, $insert3);
	mysqli_query($conn, $insert4);
}

$time_end = microtime(true);
//calculating time
$time = $time_end - $time_start;
echo "Time taken in seconds (reset tables and write to MySQL): $time";

fclose($file);

//record time to file
//$file = fopen("../MySQL_write.txt", "a");
//file_put_contents($file, $time);
//fclose($file);

?>

<?php
//$time_end = microtime(true);
//calculating time
//$time = $time_end - $time_start;
//echo "Time taken in seconds (write to MySQL): $time";
?>