<?php

session_start();
if (isset($_SESSION['loggedIn'])) {
    header("location:maininterface.php");
    exit();
}
$exist = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/dbconnect.php';
    $firstname = $_POST["username"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];
    $userNameCheck = "SELECT * from `userdetails` WHERE `User Name` = '$username'";
    $resultOfUserNameCheck = mysqli_query($con, $userNameCheck);
    $numOfUserName = mysqli_num_rows($resultOfUserNameCheck);
    if ($numOfUserName > 0) {
        $exist = true;
    } else {
        $exist = false;
        if (($password != "") && ($password == $repassword) && ($exist == false)) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `userdetails` (`First Name`, `Last Name`, `User Name`, `Password`, `Time`) VALUES ('$firstname', '$lastname', '$username', '$passwordHash', current_timestamp())";

            $result = mysqli_query($con, $sql);
            if ($result) {
                header("location:login.php");
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Us</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link rel="stylesheet" href="css/signup-login.css">
    <link rel="stylesheet" href="css/phone.css">
    <link rel="stylesheet" href="css/utils.css">

</head>

<body>
    <nav>
        <div id="logo">
            <a href="index.php"><img src="img/logo.png" alt="E-Diary" height="100"></a>
        </div>
    </nav>

    <section id="signup-section">
        <?php
        if ($exist) {
            echo
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Username</strong> Alread Exist.Please Choose Another Username.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <div id="signup-box">
            <form method="post">
                <div class="input-field">
                    <label for="firstname">First Name:</label>
                    <input type="text" name="firstname" id="firstname">
                    <span id="invalidF" class="hideinvalid">*Invalid Name</span>
                </div>
                <div class="input-field">
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" id="lastname">
                    <span id="invalidL" class="hideinvalid">*Invalid Name</span>
                </div>
                <div class="input-field">
                    <label for="firstname">User Name:</label>
                    <input type="text" name="username" id="username">
                    <span id="invalidU" class="hideinvalid">*Invalid UserName</span>
                </div>
                <div class="input-field">
                    <label for="firstname">Password:</label>
                    <input type="password" name="password" id="password">
                    <span id="invalidPW" class="hideinvalid">*Invalid Password</span>
                </div>
                <div class="input-field">
                    <label for="firstname">Re-Password:</label>
                    <input type="password" name="repassword" id="repassword">
                    <span id="invalidRPW" class="hideinvalid">*Password Doesn't Match</span>
                </div>
                <input class="checkbox" type="checkbox" name="" id="aggrement">&nbsp;<span class="aggrement-text">I agree the
                    term and condition</span><br>
                <div class="data-field">
                    <button type="submit" id="signupbtn" class="btn" disabled=true>SIGN UP</button>
                    <p><a href="index.php" id="retruntohome">Return to home page</a></p>
                </div>
            </form>
        </div>
    </section>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <script src="js/validation.js"></script>
</body>

</html>