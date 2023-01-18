<?php require "includes/header.php"; ?>
<?php require "Config.php"; ?>

<?php 
if(isset($_SESSION['username'])){
  header('location:index.php');
}

if(isset($_POST['signin'])){
    if(empty($_POST['mail']) or empty($_POST['pass'])){
      echo "some data missed";
    }else{
      $email=$_POST['mail'];
      $password = $_POST['pass'];

      $sql="SELECT * FROM users WHERE email='$email'";
      $res=$conn->query($sql);
      $res->execute();
      $data=$res->fetch(PDO::FETCH_ASSOC);
   

      if($res->rowCount() > 0){

        if(password_verify($password, $data['password'])) {
          echo "Login Successfully";

          $_SESSION['username']= $data['username'];
          header('location:index.php');

        }else{
        echo "Username or Password is not correct";

        }
      }else{
        echo "Username or Password is not correct";
      }

    }
  
}

?>

<main class="form-signin w-50 m-auto">
  <form method="post" action="login.php">
    <!-- <img class="mb-4 text-center" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
    <h1 class="h3 mt-5 fw-normal text-center">Please sign in</h1>

    <div class="form-floating">
      <input name="mail" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input name="pass" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button name="signin" class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <h6 class="mt-3">Don't have an account  <a href="logout.php">Create your account</a></h6>
  </form>
</main>
<?php require "includes/footer.php"; ?>
