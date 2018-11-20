<?php 
	session_start();
	require_once("../tools.php");
	require_once("imagecmt_CmtDao.php");


	$id = sessionVar("uid");
	$name = sessionVar("uname");

	$bdnum =  requestValue("num");
	$page = requestValue("page");
	$cmt = requestValue("cmt");
	$num = requestValue("cmtnum");

	if($id && $name && $bdnum && $cmt){
		$dao = new ImageCmtDao();
		$dao->updateCmt($num, $id, $name, $bdnum, $cmt);

		goNow(bdUrl("image_View.php", $bdnum, $page));
	}
 ?>
