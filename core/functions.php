<?php


function check_if_logged_in() {
	if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
		$role = $_SESSION['role'];
		switch ($role) {
			case 'admin':
				header("Location:./admin/dashboard.php");
				break;
			case "visitor":
                header("Location:./visitor/dashboard.php");
                break;
			default:
				break;
		}
	}
}