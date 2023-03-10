<?php require "includes/header.php"; ?>

<?php require "Config.php"; ?>

<?php
if(isset($_SESSION['username'])){
  header('location:index.php');
}

if(isset($_POST['submit'])){
  if(empty($_POST['email'])or empty($_POST['username'])or empty($_POST['password'])){
    echo "Some Data Missing";
  }else{
    $email = $_POST['email'];
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $stmt = $conn->prepare("INSERT INTO users(email, username, password) VALUES(:email, :username, :mypassword)");

    $stmt->execute([':email'=> $email,
                    ':username'=> $user,
                    ':mypassword' => password_hash($pass, PASSWORD_DEFAULT),
  ]);
  
}
}



?>

<main class="form-signin w-50 m-auto">
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
   
    <h1 class="h3 mt-5 fw-normal text-center">Please Register</h1>

    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>

    <div class="form-floating">
      <input name="username" type="text" class="form-control" id="floatingInput" placeholder="username">
      <label for="floatingInput">Username</label>
    </div>

    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">register</button>
    <h6 class="mt-3">Aleardy have an account?  <a href="login.php">Login</a></h6>

  </form>
</main>
<?php require "includes/footer.php"; ?>
