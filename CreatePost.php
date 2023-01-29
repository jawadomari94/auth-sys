<?php require "includes/header.php"; ?>
<?php require "Config.php"; ?>

<?php
if(isset($_POST['submit'])){
  if(empty($_POST['title'])or empty($_POST['body'])){
    echo "Some Data Missing";
  }else{
    $title = $_POST['title'];
    $body = $_POST['body'];
    $username = $_SESSION['username'];
    $stmt = $conn->prepare("INSERT INTO posts(title, body, username) VALUES(:title, :body, :username)");

    $stmt->execute([':title'=> $title,
                    ':body'=> $body,
                    ':username' => $username,
  ]);
  
}
}
?>
<main class="form-signin w-50 m-auto">
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
   
    <h1 class="h3 mt-5 fw-normal text-center">Create Post</h1>

    <div class="form-floating">
      <input name="title" type="text" class="form-control" id="floatingInput" placeholder="title">
      <label for="floatingInput">Title</label>
    </div>

    <div class="form-floating">
      <input name="username" type="hidden" class="form-control" id="floatingInput" placeholder="username">
    </div>

    <div class="form-floating mt-3">
        <textarea  name="body" placeholder="body" class="form-control"></textarea>
      <label for="floatingPassword">body</label>
    </div>

    <button name="submit" class="w-100 btn btn-lg btn-primary mt-3" type="submit">Create Post</button>

  </form>
</main>

<?php require "includes/footer.php" ?>