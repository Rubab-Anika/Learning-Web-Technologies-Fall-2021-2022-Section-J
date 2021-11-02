<?php
$tname = "";
$dept = "";
$notice = "";
$date = "";
$action = "";
$editId = "";

if (!empty($_POST["teachername"])) $tname = $_POST["teachername"];
if (!empty($_POST["department"])) $dept = $_POST["department"];
if (!empty($_POST["notice"])) $notice = $_POST["notice"];
if (!empty($_POST["date"])) $date = $_POST["date"];
if (!empty($_POST["action"])) $action = $_POST["action"];
?>

<html>

<body>
    <center>
        <a href="home.php">Back </a> |
        <a href="../controller/logout.php">logout </a>
    </center>
    <?php


    if ($action == "add") {
        $fileName = "../model/notice.txt";
        $data = fopen($fileName, "a");
        $user = $tname . "|" . $dept . "|" . $notice . "|" . $date . "\r\n";
        fwrite($data, $user);
        fclose($data);
    } else if ($action == "delete") {
        $deleteId = $_POST['deleteId'];
        $readData = file("../model/notice.txt", FILE_IGNORE_NEW_LINES);
        $arrOut = array();

        foreach ($readData as $key => $val) {
            if ($key != $deleteId) $arrOut[] = $val;
        }

        $strArr = implode("\n", $arrOut);
        $fp = fopen('../model/notice.txt', 'w');
        if (count($readData) < 0) {
            fwrite($fp, $strArr . "\r\n");
        } else
            fwrite($fp, $strArr);
        fclose($fp);
    } else if ($action == "edit") {
        $editId = $_POST["editId"];
        $readData = file("../model/notice.txt", FILE_IGNORE_NEW_LINES);
        $readData[$editId] = ($tname . "|" . $dept . "|" . $notice . "|" . $date);
        $writeData = implode("\r\n", $readData);
        $fileWrite = fopen('../model/notice.txt', 'w+');
        fwrite($fileWrite, $writeData . "\r\n");
        fclose($fileWrite);
    }


    $fileName = "../model/notice.txt";
    $readData = file("../model/notice.txt", FILE_IGNORE_NEW_LINES);
    ?>
    <center>
        <h1>See All Notice List</h1>
        <table border="1" width="50%">
            <tr>
                <td>ID</td>
                <td>Teacher Name</td>
                <td>Department</td>
                <td>Notice</td>
                <td>Date</td>
                <td colspan="2">Action</td>
            </tr>

            <?php
            $cnt = 1;
            if (count($readData) > 0) {
                foreach ($readData as $key => $val) {
                    list($tname, $dept, $notice, $date) = array_pad(explode("|", $val, 4), 4, null);
            ?>
                    <tr>
                        <td><?= $cnt ?></td>
                        <td><?= $tname ?></td>
                        <td><?= $dept ?></td>
                        <td><?= $notice ?></td>
                        <td><?= $date ?></td>
                        <td>
                            <form action="noticedit.php" method="post" name="editForm" id="editForm">
                                <input type="submit" id="btnEdit" name="btnEdit" value="Edit" />
                                <input type="hidden" id="editId" name="editId" value="<?php echo $key; ?>" />
                                <input type="hidden" name="action" id="action" value="edit" />
                            </form>
                            <form action="" method="post" name="deleteForm" id="deleteForm">
                                <input type="submit" id="delete" name="delete" value="Delete" onclick="return confirm('Do you want to delete this notice?');" />
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