<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  /*  Get  Post Comments Information */     
    if (!isset($_POST['id']) || !isset($_POST['access_token'])) {
      echo "{'error': -1}";
      exit;
    }
    $id=htmlspecialchars(addslashes($_POST['id']));
    $access_token=htmlspecialchars(addslashes($_POST['access_token']));
    $url = "https://graph.facebook.com/".$id."/comments?access_token=" . $access_token;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $comments = curl_exec($curl);
    curl_close($curl);
    echo $comments;
?>