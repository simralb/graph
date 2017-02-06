<?php

$page_ID = "1248913378524735";
$access_token = "EAACEdEose0cBAFxaHYiwXAtZCWbeX0i1rQaLHfOu542lt5dLtsPFqfZA8NhEpRRzqV7lrntgYEwODh1obyZADvUAGTnntAqsdrFx3ZCFBb1KOmWdtMkUpFQOiLhZBkEtGUT93d04D5R2ZAaUsftsbd1sCH03TKq8VqUOzpCpPJZBbaZCtvBZBMkl3KkprC63u1JZADIIZBMUiIlN6j1IZCwFfI9s";

  $fbpage = file_get_contents("https://graph.facebook.com/endirebadi/posts?limit=20&access_token=".$access_token);
  $post = json_decode($fbpage);

  $connection = mysqli_connect("localhost", "root", "cactus001!!") or die('error');
  mysqli_select_db($connection, "facebook") or die('err2');
mysqli_query($connection, "SET CHARACTER SET 'utf8'");



foreach($post->data as $posts => $item) {

  if (!empty($item->name)){
      echo "Page:$item->name", "<br/>";

} else {
  }

  if (!empty($item->id)){
      echo "id:$item->id", "<br/>";

} else {
  }
  if (!empty($item->message)){
      echo "Posts:$item->message", "<br/>";

} else {
  }

if (!empty($item->picture)){
      echo 'Picture: <img src="'.$item->picture.'">',"<br/>";
  } else {
    }

  if (!empty($item->source)){
    echo   'Video:<iframe src="'.$item->source.'"></iframe>', "<br/>";
    } else {
      }
      $result = mysqli_query($connection,"SELECT id FROM graph WHERE id = '".$item->id."'");
    if(mysqli_num_rows($result) > 0 ) {


    } else {
        mysqli_query($connection, "INSERT INTO graph(page_name, id, post, picture, video) VALUES  ('".$item->name."', '".$item->id."' , '".$item->message."', '".$item->picture."',  '".$item->source."')") or die('err_f');
    }


}

    mysqli_close($connection);
?>
