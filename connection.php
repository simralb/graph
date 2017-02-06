<?php

$connection = mysqli_connect("localhost", "root", "cactus001!!") or die('error');
mysqli_select_db($connection, "Facebook") or die('err2'); // Selecting Database from Server





  mysqli_query($connection, "INSERT INTO graph(post, video, picture) VALUES  " 





  mysqli_close($connection);




 ?>
