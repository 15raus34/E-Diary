<?php
// UNSETTING AND DESTROOYING sessions--> 
session_start();
session_unset();
session_destroy();

header("location: ../index.php");
exit();
?>