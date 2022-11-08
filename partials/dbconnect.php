<?php 
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "ediary1534";

    $con = mysqli_connect($server,$username,$password,$database);
     
    if(!$con){
        echo "DataBase Disconnected";
    }
?>