<?php 
	require_once("../tools.php");
	require_once("image_BoardDao.php");

	$num = requestValue("num");
	$page = requestValue("page");
	$dao = new ImageBoardDao();
	$dao->deleteMsg($num);

	//글 목록 페이지로 복귀
	goNow(bdUrl("image_Board.php", 0, $page));
 ?>