<?php
session_start();
$login = true;
;
if (isset($_SESSION['loggedIn'])) {
    header("location:maininterface.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $userCheck = "SELECT * from userdetails WHERE `User Name` = '$username'";
    $resultOfUserCheck = mysqli_query($con, $userCheck);
    $numOfUser = mysqli_num_rows($resultOfUserCheck);
    if ($numOfUser == 1) {
        while ($row = mysqli_fetch_assoc($resultOfUserCheck)) {
            if (password_verify($password, $row['Password'])) {
                echo $numOfUser;
                $login = true;
                session_start();
                $_SESSION['loggedIn'] = true;
                $_SESSION['username'] = $username;
                if ($username == "admin") {
                    header("location:admin.php");
                    exit();
                } else {
                    header("location:maininterface.php");
                }
            } else {
                $login = false;
            }
        }
    } else {
        $login = false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet" href="css/popup.css">
    <link rel="stylesheet" href="css/signup-login.css">
    <link rel="stylesheet" href="css/phone.css">

</head>

<body>
    <nav>
        <div id="logo">
            <a href="index.php"><img src="img/logo.png" alt="E-Diary" height="100"></a>
        </div>
    </nav>
    <section id="login-section">
        <?php
        if (!$login) {
            echo
                '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Please</strong> Enter Correct Credentials.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <div id="login-box">
            <form method="POST" action="#">
                <div class="input-field">
                    <label for="firstname">User Name:</label>
                    <input type="text" name="username">
                </div>
                <div class="input-field">
                    <label for="firstname">Password:</label>
                    <input type="password" name="password">
                </div>
                <div class="data-field">
                    <button class="btn">SIGN IN</button>
                        <p><a href="index.php" id="retruntohome">Return to home page</a></p>
                </div>
            </form>
        </div>
    </section>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
        crossorigin="anonymous"></script>

</body>

</html>