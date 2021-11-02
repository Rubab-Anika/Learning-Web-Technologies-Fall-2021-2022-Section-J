<?php
session_start();
include('header.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile Page</title>
</head>

<body>
    <center>
        <a href="home.php">Back </a> |
        <a href="../controller/logout.php">logout </a>
        <h2>Profile Page</h2>
    </center>
    <center>
        <table border="2" cellspacing="0" width="30%">
            <tr>
                <td>
                    NAME : <?php echo ($_SESSION['u_name']); ?>
                </td>
            </tr>
            <tr>
                <td>
                    EMAIL : <?php echo ($_SESSION['email']); ?>
                </td>
            </tr>
            <tr>
                <td>
                    DEPARTMENT : <?php echo ($_SESSION['dept']); ?>
                </td>
            </tr>
            <tr>
                <td>
                    USER TYPE : <?php echo ($_SESSION['type']); ?>
                </td>
            </tr>


    </center>
    </table>
</body>

</html>