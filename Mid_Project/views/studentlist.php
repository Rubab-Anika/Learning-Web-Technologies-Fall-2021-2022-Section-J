<?php
$username = "";
$password = "";
$email = "";
$usertype = "";
$action = "";
$editId = "";

if (!empty($_POST["username"])) $username = $_POST["username"];
if (!empty($_POST["password"])) $password = $_POST["password"];
if (!empty($_POST["email"])) $email = $_POST["email"];
if (!empty($_POST["usertype"])) $usertype = $_POST["usertype"];
if (!empty($_POST["action"])) $action = $_POST["action"];
?>

<html>

<body>
    <center>
        <a href="home.php">Back </a> |
        <a href="../controller/logout.php">logout </a>
    </center>
    <?php


    if ($action == "delete") {
        $deleteId = $_POST['deleteId'];
        $readData = file("../model/student.txt", FILE_IGNORE_NEW_LINES);
        $arrOut = array();

        foreach ($readData as $key => $val) {
            if ($key != $deleteId) $arrOut[] = $val;
        }

        $strArr = implode("\n", $arrOut);
        $fp = fopen('../model/student.txt', 'w');
        if (count($readData) < 0) {
            fwrite($fp, $strArr . "\r\n");
        } else
            fwrite($fp, $strArr);
        fclose($fp);
    } else if ($action == "edit") {
        $editId = $_POST["editId"];
        $readData = file("../model/student.txt", FILE_IGNORE_NEW_LINES);
        $readData[$editId] = ($username . "|" . $password . "|" . $email . "|" . $usertype);
        $writeData = implode("\r\n", $readData);
        $fileWrite = fopen('../model/student.txt', 'w+');
        fwrite($fileWrite, $writeData . "\r\n");
        fclose($fileWrite);
    }
    $fileName = "../model/student.txt";
    $readData = file("../model/student.txt", FILE_IGNORE_NEW_LINES);
    ?>
    <center>
        <h1>See All Student Details</h1>
        <table border="1" width="50%">
            <tr>
                <td>ID</td>
                <td>USER NAME</td>
                <td>EMAIL</td>
                <td>USER TYPE</td>
                <td colspan="2">Action</td>
            </tr>

            <?php
            $cnt = 1;
            if (count($readData) > 0) {
                foreach ($readData as $key => $val) {
                    list($username, $password, $email, $usertype) = array_pad(explode("|", $val, 4), 4, null);
            ?>
                    <tr>
                        <td><?= $cnt ?></td>
                        <td><?= $username ?></td>
                        <td><?= $email ?></td>
                        <td><?= $usertype ?></td>
                        <td>
                            <form action="studentedit.php" method="post" name="editForm" id="editForm">
                                <input type="submit" id="btnEdit" name="btnEdit" value="Edit" />
                                <input type="hidden" id="editId" name="editId" value="<?php echo $key; ?>" />
                                <input type="hidden" name="action" id="action" value="edit" />
                            </form>
                            <form action="" method="post" name="deleteForm" id="deleteForm">
                                <input type="submit" id="delete" name="delete" value="Delete" onclick="return confirm('Do you want to delete this record?');" />
                                <input type="hidden" id="deleteId" name="deleteId" value="<?php echo $key; ?>" />
                                <input type="hidden" name="action" id="action" value="delete" />
                            </form>
                        </td>
                    </tr>
            <?php
                    $cnt++;
                }
            } else {
                echo "No Record Found";
            }
            ?>
            <tr>
            </tr>
        </table>
    </center>
</body>

</html>