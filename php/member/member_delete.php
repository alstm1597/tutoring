<?php
	session_start();

	require_once("../tools.php");
	require_once("MemberDao.php");

	$id = sessionVar("uid");
	$dao = new MemberDao();
	$dao->deleteMember($id);

	unset($_SESSION["uid"]);
	unset($_SESSION["uname"]);

	echo "<script>alert('회원탈퇴 성공!')</script>";
	goNow(MAIN_PAGE);
 ?>