<?php
// INSERT INTO `admins` (`sno`, `username`, `password`, `datetime`) VALUES ('1', 'charan', '123', current_timestamp()); 
$login = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include "../Database_Files/_dbusersconnect.php";
  $username = $_POST["username"];
  $password = $_POST["password"];

  //$sql = "Select * from admins where username='$username' AND password='$password'";
  $sql = "SELECT * FROM `admins` WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);

  $num = mysqli_num_rows($result);

  if ($num == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($password, $row['password'])) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location: Welcome.php");
      } else {
        $showError = "Invalid Credentials";
      }
      
    }
  } else {
    $showError = "Invalid Credentials";
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
  <?php
  require '../Partials/_nav.php'
  ?>
  <?php
  if ($login) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sucess!</strong> You are logged in.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
  if ($showError) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> ' . $showError . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
  ?>

  <div class="container my-4">
    <h1 class="text-center">Login SEES Admin</h1>
    <form action="../LoginSystem/login.php" method="post" style="
     display: flex;
     flex-direction: column;
     align-items: center;
     ">
      <div class="form-group col-md-6">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">

      </div>
      <div class="form-group col-md-6">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
        <br>
      </div>

      <button type="submit" class="btn btn-primary col-md-6">Login</button>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>