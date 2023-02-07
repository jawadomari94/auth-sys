<?php
require "Config.php";

if(isset($_POST['insert'])){

    $post_id = $_POST['post_id'];
    $rating = $_POST['rating'];
    $user_id = $_POST['user_id'];

$delete = "DELETE FROM rates WHERE post_id='$post_id' AND user_id='$user_id'";   
$del = $conn->query($delete);
$del->execute();

$insert = $conn->prepare("INSERT INTO rates(post_id, rating, user_id) 
    VALUES (:post_id, :rating, :user_id)");

$insert->execute([
    ':post_id' =>$post_id,
    ':rating' =>$rating,
    ':user_id' => $user_id,
]);





}

?>