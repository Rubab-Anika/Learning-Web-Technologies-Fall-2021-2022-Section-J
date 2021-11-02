 <?php
    $action = "";
    if (!empty($_POST["action"])) $action = $_POST["action"];
    $editId = "";
    if ($action == "edit") {


        $editId = $_POST["editId"];
        $fileName = "../model/notice.txt";
        $readData = file("../model/notice.txt", FILE_IGNORE_NEW_LINES);


        list($tname, $dept, $notice, $date) = array_pad(explode("|", $readData[$editId], 4), 4, null);
        $action = "edit";
        $submit = "Update";
        $formTitle = "Edit Notice";
    } else {
    }
    ?>

 <html>

 <head>
     <title>Notice</title>
 </head>

 <body>
     <center>
         <a href="home.php">Back </a> |
         <a href="../controller/logout.php">logout </a>
     </center>
     <center>
         <form action="noticelist.php" method="post" name="recordForm" id="recordForm">
             <label><?= $formTitle ?></label>
             <table style="border:3px solid black;" width="550">


                 <tr>
                     <td>Name:</td>
                     <td><input type="text" name="teachername" value="<?= $tname ?>" /></td>
                 </tr>
                 <tr>
                     <td>Department:</td>
                     <td><input type="text" name="department" value="<?= $dept ?>" /></td>
                 </tr>
                 <tr>
                     <td>Notice:</td>
                     <td><input type="text" name="notice" value="<?= $notice ?>" /></td>
                 </tr>
                 <tr>
                     <td>Date:</td>

                     <td><input type="date" name="date" value="<?= $notice ?>" /></td>

                 </tr>
                 <tr>
                     <td>&nbsp;</td>
                     <td>
                         <input type="hidden" name="editId" value="<?= $editId ?>" />
                         <input type="submit" name="btnSubmit" value="<?= $submit ?>" />
                         <input type="hidden" name="action" value="<?= $action ?>" />
                     </td>
                 </tr>
             </table>
         </form>
     </center>
 </body>

 </html>