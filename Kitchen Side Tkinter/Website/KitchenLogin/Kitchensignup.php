<?php
// INSERT INTO `admins` (`sno`, `username`, `password`, `datetime`) VALUES ('1', 'charan', '123', current_timestamp()); 

session_start();

if (!isset($_SESSION['Kitchenloggedin']) || $_SESSION['Kitchenloggedin'] != true) {
  header("location: Kitchenlogin.php");
  exit;
}

$showAlter = false;
$showError =  false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "../Database_Files/_dbusersconnect.php";
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $existSql = "SELECT * FROM `kitchen_staff` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);

    if ($numExistRows > 0) {
        $showError = "Account with the same username already exist";
    } else {
        if (($password == $cpassword)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `kitchen_staff` (`username`, `password`, `datetime`) VALUES ('$username', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $showAlter = true;
            }
        } else {
            $showError = "Passwords do not match";
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <?php
    require '../Partials/_kitchennav.php'
    ?>
    <?php
    if ($showAlter) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sucess!</strong> Your account is now created.
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
        <h1 class="text-center">Sign Up SEES Kitchen Staff</h1>
        <form action="../KitchenLogin/Kitchensignup.php" method="post" style="
     display: flex;
     flex-direction: column;
     align-items: center;
     ">
            <div class="form-group col-md-6">
                <label for="username">Username</label>
                <input type="text" maxlength="20" class="form-control" id="username" name="username" aria-describedby="emailHelp">

            </div>
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" maxlength="20" class="form-control" id="password" name="password">
            </div>
            <div class="form-group col-md-6">
                <label for="cpassword">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
                <small id="emailHelp" maxlength="20" class="form-text text-muted">Make sure to type the same password</small>
            </div>

            <button type="submit" class="btn btn-primary col-md-6">SignUp</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>