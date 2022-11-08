<?php
include 'partials/dbconnect.php';
session_start();
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
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
        $sqlDelete = "DELETE FROM `usersdata` WHERE `usersdata`.`S.No.` = $sno";
        $result = mysqli_query($con, $sqlDelete);
        // header("location:maininterface.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['snoEdit'])) {
            $sno = $_POST["snoEdit"];
            $remarkEdit = $_POST["remarkEdit"];
            $sqlUpdate = "UPDATE `usersdata` SET `Remarks` = '$remarkEdit' WHERE `usersdata`.`S.No.` = $sno";
            $sqlUpdateResult = mysqli_query($con, $sqlUpdate);
            if ($sqlUpdateResult) {
                $edited = true;
            } else {
                $edited = false;
            }
        } else {
            $username = $_SESSION['username'];
            $dataDate = $_POST["dataDate"];
            $subject = $_POST["subject"];
            $remark = $_POST["remark"];
            $UserDataInsert = "INSERT INTO `usersdata` (`User Name`, `Data Date`, `Subject`, `Remarks`, `TimeStamp`) VALUES ('$username', '$dataDate', '$subject', '$remark', current_timestamp());";
            $UserDataInsertResult = mysqli_query($con, $UserDataInsert);
            if ($UserDataInsertResult) {
                $added = true;
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
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/utils.css">

</head>

<body>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="maininterface.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="form-group">
                            <label for="title">Subject</label>
                            <input type="text" class="form-control" id="subjectEdit" name="subjectEdit" aria-describedby="emailHelp" readonly>
                        </div>

                        <div class="form-group">
                            <label for="desc">Remark</label>
                            <textarea class="form-control" id="remarkEdit" name="remarkEdit" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
        <form id="diaryform" method="POST">
            <div class="form-group row">
                <label for="date" class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="dataDate" name="dataDate">
                </div>
            </div>
            <div class="form-group row">
                <label for="remarks" class="col-sm-2 col-form-label">Remarks</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="remark" name="remark" placeholder="Enter The Remarks">
                </div>
            </div>
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Subject</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="subject" id="BusinessStatatics" value="Business Statatics">
                            <label class="form-check-label" for="BusinessStatatics">
                                Business Statatics
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="subject" id="JavaProgramming" value="Java Programming">
                            <label class="form-check-label" for="JavaProgramming">
                                Java Programming-I
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="subject" id="FinancialAccounting" value="Financial Accounting">
                            <label class="form-check-label" for="FinancialAccounting">
                                Financial Accounting
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="subject" id="ComputerOrganization" value="Computer Organization">
                            <label class="form-check-label" for="ComputerOrganization">
                                Computer Organization
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="subject" id="WebProgramming" value="Web Programming" checked>
                            <label class="form-check-label" for="WebProgramming">
                                Web Programming-I
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" id="btnSnip" style="background-color: rgb(81, 231, 81);color: black;">SNIP IT</button>
                </div>
            </div>
        </form>

        <div id="table">
            <h1>Your Diary</h1>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">S.No.</th>
                        <th scope="col">Date</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Remarks</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id='tableBody'>
                    <?php
                    $username = $_SESSION['username'];
                    $userData = "SELECT * from `usersdata` WHERE `User Name` = '$username'";
                    $result = mysqli_query($con, $userData);
                    $sno = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $sno = $sno + 1;
                        echo "<tr>
                                <th scope='row'>" . $sno . "</th>
                                <td>" . $row['Data Date'] . "</td>
                                <td>" . $row['Subject'] . "</td>
                                <td>" . $row['Remarks'] . "</td>
                                <td> <i class='edit fa fa-pencil' aria-hidden='true' id=" . $row['S.No.'] . "></i><i class='delete fa fa-trash-o' aria-hidden='true' id=d" . $row['S.No.'] . "></i></td>
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
        let edit = document.getElementsByClassName("edit");
        Array.from(edit).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("EDITING");
                tr = e.target.parentNode.parentNode;
                subject = tr.getElementsByTagName("td")[1].innerText;
                remark = tr.getElementsByTagName("td")[2].innerText;
                subjectEdit.value = subject;
                remarkEdit.value = remark;
                snoEdit.value = e.target.id;
                $('#editModal').modal('toggle');
            })
        });

        let deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("delete ");
                sno = e.target.id.substr(1);

                if (confirm("Are you sure you want to delete this note!")) {
                    console.log("yes");
                    window.location = `maininterface.php?delete=${sno}`;
                } else {
                    console.log("no");
                }
            })
        });
    </script>
</body>

</html>