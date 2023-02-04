<?php require "includes/header.php"; ?>

<?php require "Config.php"; ?>
<?php 
if(isset($_SESSION['username'])){
  header('location:index.php');
}

if(isset($_POST['submit'])){
  if(empty($_POST['username'])or empty($_POST['post_id'])or empty($_POST['comment'])){
    echo "Some Data Missing";
  }else{
    $username = $_POST['username'];
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    $stmt = $conn->prepare("INSERT INTO comments(username, post_id, comment) VALUES(:username, :post_id, :comment)");

    $stmt->execute([':username'=> $username,
                    ':post_id'=> $post_id,
                    ':comment' => $comment,
  ]);
  
}
}
?>