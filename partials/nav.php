<?php
echo
'<nav>
    <div id="logo">
        <a href="index.php"><img src="img/logo.png" alt="E-Diary" height="100"></a>
    </div>
    <div id="navitems">';
if ($loggedIn) {
    if ($_SESSION["username"] == 'admin') {
        echo
        '<a href="admin.php"><button class="btn">' . $_SESSION["username"] . '</button></a>
        <a href="partials/logout.php"><button class="btn">LOG OUT</button></a>';
    } else {
        echo
        '<a href="maininterface.php"><button class="btn">' . $_SESSION["username"] . '</button></a>
        <a href="partials/logout.php"><button class="btn">LOG OUT</button></a>';
    }
}
if (!$loggedIn) {
    echo
    '<a href="signup.php"><button class="btn">SIGN UP</button></a>
    <a href="login.php"><button class="btn">SIGN IN</button></a>';
}
echo
'</div>
</nav>';
