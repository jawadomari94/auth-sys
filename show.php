<?php require "includes/header.php"; ?>
<?php require "Config.php"; ?>
<?php 

if(isset($_GET['Id'])){

    $id = $_GET['Id'];

    $sql = "SELECT * FROM posts WHERE Id='$id'";
    $Post = $conn->query($sql);
    $Post->execute();

    $onepost = $Post->fetch(PDO::FETCH_OBJ);
}
?>
<main class="form-signin w-50 m-auto mt-5">
    <div class="card">
        <div class="card-body">
                    <h5 class="card-title"><?php echo $onepost->title;  ?></h5>
                    <p class="card-text"><?php echo $onepost->body;  ?></p>
                </div>
        </div>
    </div>
</main>
<?php require "includes/footer.php"; ?>