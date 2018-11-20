<?php 
	require_once("../tools.php");
	require_once("cmt_CmtDao.php");

	$num = requestValue("num");
	$page = requestValue("page");
	$cmtnum = requestValue("cmtnum");
	$dao = new CmtDao();
	$dao->deleteCmsg($cmtnum);

	//글 목록 페이지로 복귀
	goNow(bdUrl("board_View.php", $num, $page));
 ?>