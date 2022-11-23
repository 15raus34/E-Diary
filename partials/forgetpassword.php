<?php
session_start();
$verify = true;
if (isset($_SESSION['loggedIn'])) {
    header("location:../maininterface.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnect.php';
    $username = $_POST["username"];
    $securitycode = $_POST["securitycode"];
    $newpassword = $_POST["newpassword"];
    $againnewpassword = $_POST["againnewpassword"];
    if ($username == "admin") {
        header("location:../index.php");
        exit();
    }
    $userCheck = "SELECT * from userdetails WHERE `User Name` = '$username'";
    $resultOfUserCheck = mysqli_query($con, $userCheck);
    $numOfUser = mysqli_num_rows($resultOfUserCheck);
    if ($numOfUser == 1) {
        while ($row = mysqli_fetch_assoc($resultOfUserCheck)) {
            if (password_verify($securitycode, $row['Security Code'])) {
                $verify = true;
                $newPasswordHash = password_hash($newpassword, PASSWORD_DEFAULT);
                $sqlPasswordChange = "UPDATE `userdetails` SET `Password` = '$newPasswordHash' WHERE `userdetails`.`User Name` = '$username'";
                $result = mysqli_query($con, $sqlPasswordChange);
                if ($result) {
                    header("location:../login.php");
                }
            } else {
                $verify = false;
            }
        }
    } else {
        $verify = false;
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

    <link rel="stylesheet" href="../css/utils.css">
    <link rel="stylesheet" href="../css/popup.css">
    <link rel="stylesheet" href="../css/signup-login.css">
    <link rel="stylesheet" href="../css/phone.css">

</head>

<body>
    <nav>
        <div id="logo">
            <a href="../index.php"><img src="../img/logo.png" alt="E-Diary" height="100"></a>
        </div>
    </nav>
    <section id="login-section">
        <?php
        if (!$verify) {
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
                    <input type="text" name="username" id="username">
                    <span id="invalidU" class="hideinvalid">*Invalid UserName</span>
                </div>
                <div class="input-field">
                    <label for="firstname">Security Code:</label>
                    <input type="password" name="securitycode" id="securitycode">
                    <span id="invalidSC" class="hideinvalid">*Invalid Security Code</span>
                </div>
                <div class="input-field">
                    <label for="firstname">New Password:</label>
                    <input type="password" name="newpassword" id="newpassword">
                    <span id="invalidPW" class="hideinvalid">*Invalid Password</span>
                </div>
                <div class="input-field">
                    <label for="firstname">New Password Again:</label>
                    <input type="password" name="againnewpassword" id="againnewpassword">
                    <span id="invalidRPW" class="hideinvalid">*Password Doesn't Match</span>
                </div>
                <div class="data-field">
                    <button class="btn">Change Password</button>
                    <p><a href="../index.php" id="retruntohome">Return to home page</a></p>
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
    <script src="../js/validaterepass.js"></script>

</body>

</html>