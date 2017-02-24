<?php

set_time_limit(0);

$connection = mysqli_connect("localhost", "root", "cactus001!!") or die("error_1");
mysqli_select_db($connection, "inserting") or die("error_2");


function generate_random_string($length = 32) {

  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, strlen($characters) - 1)];

  }
  return $randomString;
}
function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}


$begin = new DateTime( '1950-01-01' );
$end = new DateTime( '2017-01-01' );

$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);

foreach ( $period as $dt ) {

  $date_add = $dt->format('Y-m-d');

  $counter = 0;

  $checkdate = mysqli_query($connection, "SELECT date_add as qtt FROM baza WHERE date_add = '".$date_add."'");
  $counter = mysqli_num_rows($checkdate);

  $sql_arr = array();

  do {
    $counter++;
    $hash = generate_random_string(32);
    $number =  UniqueRandomNumbersWithinRange(0,1000,1001);
    echo $counter, "<br/>";

    $result = mysqli_query($connection,"SELECT hash_code FROM baza WHERE hash_code = '".$hash."'") or die ('error_r');
    if(mysqli_num_rows($result) > 0 ) {
      $hash = generate_random_string(32);
    } else {
      $sql_arr[] = "('".$hash."', '".$date_add."', '".$number[$counter]."')";
    }



  }  while ($counter <= 999);

  print_r($sql_arr);

  $tmp = JOIN(",", $sql_arr);

  mysqli_query($connection, "INSERT INTO baza(hash_code, date_add, price) VALUES ".$tmp."  ") or die('mysqli_error()');

}



mysqli_close($connection);




?>
