<?php
	session_start();
	$_SESSION["currUser"] = $_POST["login_id"];
	$_SESSION["currUser_pw"] = $_POST["login_pw"];
	$_SESSION["currDisasId"] = $_POST["disaster_dropdown"];
	//header("Location: proj_index.php?disasterId=".$_POST["disaster_dropdown"]);
	
	if (isset($_POST["btLogin"])) {
		header("Location: proj_index.php");
	}
	
	if (isset($_POST["btLogout"])) {
		header("Location: dmcs_index.php?logout=true");
	}
	
	if (isset($_POST["btRegister"])) {
		header("Location: vol_register.php");
	}
	
	if (isset($_POST["btReqHelp"])) {
		header("Location: req_help.php");
	}
?>