<?php
session_start();

if (isset($_POST['submit'])) {
	$uname = $_POST['username'];
	$pass = $_POST['password'];
	$email = $_POST['email'];
	$dept = $_POST['department'];
	$type = $_POST['usertype'];

	if ($uname != "") {
		if ($pass != "") {
			if ($email != "") {
				if ($dept != "") {
					if ($type != "") {

						$des = "../image/" . $_FILES['myfile']['name'];
						$src = $_FILES['myfile']['tmp_name'];

						if (move_uploaded_file($src, $des)) {

							$dbmodel = fopen("../model/user.txt", "a");
							$user = $uname . "|" . $pass . "|" . $email . "|" . $type . "|" . $dept . "|" . $des . "\r\n";

							fwrite($dbmodel, $user);

							fclose($dbmodel);

							header('location: ../views/login.html');
						} else {
							echo "please insert a profile picture";
						}
					} else {
						echo "Invalid usertype...";
					}
				} else {
					echo "Invalid department...";
				}
			} else {
				echo "Invalid email...";
			}
		} else {
			echo "Invalid password...";
		}
	} else {
		echo "Invalid username...";
	}
}
