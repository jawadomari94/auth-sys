<?php require "includes/header.php"; ?>
<?php require "Config.php"; ?>

<?php
//$myname=$_GET='username';
  if(isset($_GET['Id'])){

    $comid=$_GET['post-id'];
    $Id=$_GET['Id'];

    $sql="DELETE FROM comments WHERE Id='$Id' and username='$_SESSION[username]'";
    $del=$conn->query($sql);
    $del->execute();

    echo '<script>window.location.href="index.php"</script>';


    

}


?>