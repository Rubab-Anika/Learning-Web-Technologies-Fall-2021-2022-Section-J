<?php
session_start();
include('header.php');

if (isset($_POST['submit'])) {
    $tname = $_POST['teachername'];
    $dept = $_POST['department'];
    $notice = $_POST['notice'];
    $date = $_POST['date'];

    if ($tname != "") {
        if ($dept != "") {
            if ($notice != "") {
                if ($date != "") {

                    $myfile = fopen("../model/notice.txt", "a");
                    $user = $tname . "|" . $dept . "|" . $notice . "|" . $date . "\r\n";
                   
                    fwrite($myfile, $user);

                    fclose($myfile);

                    header('location: ../views/home.php');
                } else {
                    echo "Invalid date...";
                }
            } else {
                echo "Invalid notice...";
            }
        } else {
            echo "Invalid department...";
        }
    } else {
        echo "Invalid teachername...";
    }
}
?>
<html>

<head>
    <title>Notice Student</title>
</head>

<body>
    <center>
        <a href="home.php">Back </a> |
        <a href="../controller/logout.php">logout </a>
    </center>

    <form method="post" action="">
        <fieldset>
            <legend>NOTICE STUDENT</legend>
            <table>
                <tr>
                    <td>Teacher Name:</td>
                    <td><input type="text" name="teachername" value=""></td>
                </tr>
                <tr>
                    <td>Department:</td>
                    <td><input type="department" name="department" value=""></td>
                </tr>
                <tr>
                    <td>Notice:</td>
                    <td><input type="text" name="notice" value=""></td>
                </tr>
                <tr>
                    <td>Date:</td>
                    <td><input type="date" name="date" value=""></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Create"></td>
                </tr>
            </table>
        </fieldset>
    </form>
</body>

</html>