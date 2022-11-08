<?php
include 'partials/dbconnect.php';
session_start();
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true || $_SESSION['username']!="admin") {
    header("location:index.php");
    exit();
} else {
    $loggedIn = true;
}
$added = false;
$edited = false;
$delete = false;
if (isset($_SESSION['loggedIn'])) {

    if (isset($_GET['delete'])) {
        $sno = $_GET['delete'];
        $delete = true;
        $sqlDelete = "DELETE FROM `userdetails` WHERE `userdetails`.`S.No.` = $sno";
        $result = mysqli_query($con, $sqlDelete);
        if($result){
            $delete=true;
        }
        else{
            $delete=false;
        }
        // header("location:maininterface.php");
    }
    if (isset($_GET['deletedata'])) {
        $sno = $_GET['deletedata'];
        $delete = true;
        $sqlDelete = "DELETE FROM `usersdata` WHERE `usersdata`.`S.No.` = $sno";
        $result = mysqli_query($con, $sqlDelete);
        if($result){
            $delete=true;
        }
        else{
            $delete=false;
        }
        // header("location:maininterface.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/utils.css">

</head>

<body>
    <?php require 'partials/nav.php' ?>
    <div id="message">
        <?php
        if ($added) {
            echo
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>New</strong> Item Added.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }
        ?>
        <?php
        if ($edited) {
            echo
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Edited</strong> Successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }
        ?>
        <?php
        if ($delete) {
            echo
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Item</strong> Deleted Successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }
        ?>
    </div>
    <hr>
    <div class="container my-3">
        <div id="table1">
            <h1>User Details</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">S.No.</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Created Date</th>
                    </tr>
                </thead>
                <tbody id='tableBody'>
                    <?php
                    $userDetailData = "SELECT * FROM `userdetails`";
                    $result = mysqli_query($con, $userDetailData);
                    $sno = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $sno = $sno + 1;
                        if($row['User Name']=="admin"){
                            echo "<tr>
                                <th scope='row'>" . $sno . "</th>
                                <td>" . $row['First Name'] . "</td>
                                <td>" . $row['Last Name'] . "</td>
                                <td>" . $row['User Name'] . "</td>
                                <td>" . $row['Time'] . "</td>
                            </tr>";
                        }
                        else{
                            echo "<tr>
                            <th scope='row'>" . $sno . "</th>
                            <td>" . $row['First Name'] . "</td>
                            <td>" . $row['Last Name'] . "</td>
                            <td>" . $row['User Name'] . "</td>
                            <td>" . $row['Time'] . "</td>
                            <td><i class='delete fa fa-trash-o' aria-hidden='true' id=d" . $row['S.No.'] . "></i></td>
                        </tr>";
                        }
                        
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div id="table2">
            <h1>Users Data</h1>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">S.No.</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Remarks</th>
                    </tr>
                </thead>
                <tbody id='tableBody'>
                    <?php
                    $usersData = "SELECT * FROM `usersdata`";
                    $result = mysqli_query($con, $usersData);
                    $sno = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $sno = $sno + 1;
                        echo "<tr>
                                <th scope='row'>" . $sno . "</th>
                                <td>" . $row['User Name'] . "</td>
                                <td>" . $row['Data Date'] . "</td>
                                <td>" . $row['Subject'] . "</td>
                                <td>" . $row['Remarks'] . "</td>
                                <td><i class='deletedata fa fa-trash-o' aria-hidden='true' id=r" . $row['S.No.'] . "></i></td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script>
        let deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("delete ");
                sno = e.target.id.substr(1);

                if (confirm("Are you sure you want to delete this user!")) {
                    console.log("yes");
                    window.location = `admin.php?delete=${sno}`;
                } else {
                    console.log("no");
                }
            })
        });
        let deletesdata = document.getElementsByClassName('deletedata');
        Array.from(deletesdata).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("delete data");
                sno = e.target.id.substr(1);

                if (confirm("Are you sure you want to delete this user!")) {
                    console.log("yes");
                    window.location = `admin.php?deletedata=${sno}`;
                } else {
                    console.log("no");
                }
            })
        });
    </script>
</body>

</html>