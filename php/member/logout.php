<?php
	session_start();
	require_once("../tools.php");

	unset($_SESSION["uid"]);
	unset($_SESSION["uname"]);
	
	echo "<script>alert('로그아웃 성공!')</script>";
	goNow(MAIN_PAGE);
 ?>