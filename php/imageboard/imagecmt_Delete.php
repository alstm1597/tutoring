<?php 
	require_once("../tools.php");
	require_once("imagecmt_CmtDao.php");

	$num = requestValue("num");
	$page = requestValue("page");
	$cmtnum = requestValue("cmtnum");
	$dao = new ImageCmtDao();
	$dao->deleteCmsg($cmtnum);

	//글 목록 페이지로 복귀
	goNow(bdUrl("iamge_View.php", $num, $page));
 ?>