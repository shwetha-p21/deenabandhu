<?php 

	include_once("./core/init.php");
	include_once("./core/database.php");

	if ($_SERVER['REQUEST_METHOD']) {
		if (isset($_POST['email']) && !empty($_POST['email'])) {
			$email =  $_POST['email'];
			$stmt=$con->prepare("select * from login where emailid=?");
            $stmt->bind_param("s",$emailid);
            $stmt->execute();
            $stmt_result=$stmt->get_result();

            if($stmt_result->num_rows>0){
    	        $data=$stmt_result->fetch_assoc();
            } else {
            	echo "";
            }


			$key = md5(time() + $email + rand());
			echo $key . "<br/>";
			echo "Password Reset Link has been sent";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Forgot Password</title>
</head>
<body>
	<h1>Forgot Password</h1>
	<form method="POST">
		<input type="email" name="email" required autofocus />
		<input type="submit" value="Submit" />
	</form>
</body>
</html>