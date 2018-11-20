<?php 
	session_start();
	require_once("../tools.php");
	require_once("cmt_CmtDao.php");


	$id = sessionVar("uid");
	$name = sessionVar("uname");

	$bdnum =  requestValue("num");
	$page = requestValue("page");
	$cmt = requestValue("cmt");
	$num = requestValue("cmtnum");

	if($id && $name && $bdnum && $cmt){
		$dao = new CmtDao();
		$dao->updateCmt($num, $id, $name, $bdnum, $cmt);

		okGo("게시글이 수정되었습니다.", bdUrl("board_View.php", $bdnum, $page));
	}else{
		errorBack("모든 칸을 작성해주십시오.");
	}
 ?>
