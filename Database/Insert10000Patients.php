<?php

//include('../config/db_connect.php');

$conn = mysqli_connect('localhost', 'test_user', 'Password@123', 'ProjectQTM');

$reset = "truncate patients;";
$result = mysqli_query($conn, $reset);

for ($x = 1; $x <= 10000; $x+=9) {
    $query="INSERT INTO `patients` (`id`, `name`, `gender`, `dob`, `age`, `phone`, `email`, `others`, `created_at`) VALUES
    ($x, 'Ricardo Milos', 'Male', '2001-10-05', 20, '+843334445555', 'dancing@abcxyz.vn', 'Hot Dancer', '2021-10-26 05:06:53'),
    ($x+1, 'Co Ba Dang Ngoc', 'Female', '1993-05-08', 28, '+84193458793', 'minhhieu@abcxyz.vn', 'Allergic to Seaweed.\r\nHusband is John Doe.', '2021-10-26 05:15:28'),
    ($x+2, 'Jessica', 'Female', '1995-09-12', 26, '+84188888888', 'mrwilson@abcxyz.vn', 'Jessica is not allergic to anything.\r\n\r\nJessica is from Hong Kong.\r\n\r\nShe was good at Chemistry.', '2021-10-27 05:20:29'),
    ($x+3, 'Johny Dang', 'Male', '1998-10-05', 23, '+84192345893', 'johhny@abcxyz.vn', 'Johnny loves seafood but is allergic to seafood. Unfortunate.', '2021-10-27 11:56:05'),
    ($x+4, 'Le Kim Tuan', 'Male', '2001-05-22', 20, '+843334445555', 'leekutti@abcxyz.vn', ':D', '2021-10-30 08:14:38'),
    ($x+5, 'Eden Haha', 'Male', '1988-10-05', 33, '+843334445555', 'realmadrid@abcxyz.vn', 'Just ignore me', '2021-10-30 08:47:06'),
    ($x+6, 'Lan Chee Onn', 'Male', '2003-10-06', 18, '+84178892822', 'cheeonn.lan@abcxyz.vn', 'Yasuo is not allergic to anything', '2021-10-30 08:52:03'),
    ($x+7, 'Tommy Yasuo', 'Male', '2001-10-01', 20, '+84178892822', 'hasagi@abcxyz.vn', 'Lan Chee Onn is not allergic to anything', '2021-10-30 08:59:52'),
    ($x+8, 'Yui Hatano', 'Female', '1941-10-06', 80, '+841788928222', 'test@abcxyz.vn', 'No information', '2021-10-30 09:09:10');";

    $result = mysqli_query($conn, $query);
    if (!$result)
    {
        echo "Error: " . mysqli_error($conn);
    }
  }

mysqli_close($conn);

?>




