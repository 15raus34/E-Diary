<?php
session_start();
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    $loggedIn = true;
} else {
    $loggedIn = false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Diary</title>
    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/phone.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
</head>

<body>
    <?php include 'partials/nav.php' ?>
    <section id="main-home-section">
        <h1>WELCOME <br>TO <br>E-DIARY</h1>
        <h4>SAVE PAPER GO DIGITAL</h4>
    </section>
    <section id="about-site-section">
        <div id="aboutus-1" class="aboutus-card">
            <div id="aboutus-1.1">
                <img src="img/aboutus1.png" alt="" height="90">
            </div>
            <div id="aboutus-1.2">
                <h3>Organized DataBase</h3>
                <p>Organising is what we do before you do something ,so that when you do it, it is not all Mixed Up. All your datas are organized in our database.</p>
            </div>
        </div>

        <div id="aboutus-2" class="aboutus-card">
            <div id="aboutus-2.1">
                <img src="img/aboutus2.png" alt="" height="90">
            </div>
            <div id="aboutus-2.2">
                <h3>Easily Editable</h3>
                <p>If you never try you will never know. As your notes are easily editable.</p>
            </div>
        </div>

        <div id="aboutus-3" class="aboutus-card">
            <div id="aboutus-3.1">
                <img src="img/aboutus3.png" alt="" height="90">
            </div>
            <div id="aboutus-3.2">
                <h3>Safe & Secured</h3>
                <p>We believe in keeping your data safe. There is nothing more important than a good, safe and secure database.</p>
            </div>
        </div>
    </section>
    <hr>
    <section id="quotes-section">
        <h1>&ldquo; GOING <span style="color:rgb(8, 177, 255);">DIGITAL </span>IS NO LONGER AN OPTION,<span style="color:rgb(8, 177, 255);">IT IS THE DEFAULT &rdquo;</span> </h1>
    </section>
    <hr>

    <section id="joinus-section">
        <div id="joinus-text">
            <h1>JOIN THE REVOLUTION</h1>
            <p>CONTROL YOUR NOTES DIGITALLY</p>
        </div>
        <div id="joinbtn">
            <a href="signup.php"><button class="btn">Join Us</button></a>
        </div>
    </section>

    <footer>
        <p>&copy;Copyright <span id="year"></span> : E-Diary</p>
    </footer>

    <script src="JS/year.js"></script>
</body>

</html>