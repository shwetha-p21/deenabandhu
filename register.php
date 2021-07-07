<?php
	include_once("./core/init.php");
	include_once("./core/database.php");

	if ($_SERVER ['REQUEST_METHOD'] === "POST") {
        if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        	$username = $_POST['username'];
            $emailid=$_POST['email'];
            $password=$_POST['password'];

        }
    }

?>