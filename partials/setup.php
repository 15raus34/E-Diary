<?php
// opening a new connection to the MySQL server--->
// DATABASE NAME : ediary1534

$server = "localhost";
$username = "root";
$password = "";

$con = mysqli_connect($server, $username, $password);

$sql = "CREATE DATABASE ediary1534";

$result = mysqli_query($con, $sql);

if ($result) {
    echo "DataBase Created";
} else {
    echo "Error Creating Database";
}
?>


<?php
// CONNECTING TO ediary1534 and creating Tables for userdetails and userdatas--> 

$database = "ediary1534";

$con = mysqli_connect($server, $username, $password, $database);

if ($con) {
    echo "DataBase Connected";
}

$sql1 = "CREATE TABLE `userdetails` (`S.No.` INT(11) NOT NULL AUTO_INCREMENT , `First Name` VARCHAR(15) NOT NULL , `Last Name` VARCHAR(15) NOT NULL , `User Name` VARCHAR(11) NOT NULL , `Security Code` VARCHAR(225) NOT NULL , `Password` VARCHAR(225) NOT NULL , `Time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`S.No.`))";

$result1 = mysqli_query($con, $sql1);

$sql2 = "CREATE TABLE `usersdata` (`S.No.` INT(11) NOT NULL AUTO_INCREMENT , `User Name` VARCHAR(11) NOT NULL , `Data Date` VARCHAR(11) NOT NULL , `Subject` VARCHAR(50) NOT NULL , `Remarks` VARCHAR(225) NOT NULL , `TimeStamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`S.No.`))";

$result2 = mysqli_query($con, $sql2);

//Creating Admin 
$username = "admin";
$password = "admin";
$securitycode = "admin";
$passwordHash = password_hash($password, PASSWORD_DEFAULT);
$securityHash = password_hash($securitycode, PASSWORD_DEFAULT);
$sql3 = "INSERT INTO `userdetails` (`First Name`, `Last Name`, `User Name`, `Security Code`, `Password`, `Time`) VALUES ('', '', '$username','$securityHash', '$passwordHash', current_timestamp())";

$result3 = mysqli_query($con, $sql3);

if ($result1 && $result2 && $result3) {
    echo "TABLEs AND ADMIN Created";
    header("location: ../index.php");
}
?>