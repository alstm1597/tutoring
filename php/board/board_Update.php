<?php 
	require_once("../tools.php");
	require_once("board_BoardDao.php");

	$num =  requestValue("num");
	$page = requestValue("page");
	$title = requestValue("title");
	$writer = requestValue("writer");
	$content = requestValue("content");
	$id = requestValue("id");

	if($title && $writer && $content && $id){
		$dao = new BoardDao();
		$dao->updateBoard($num, $title, $writer, $content, $id);

		//글 상세보기 페이지로 복귀
		okGo("게시글이 수정되었습니다.", bdUrl("board_View.php", $num, $page));
	}else{
		errorBack("모든 칸을 작성해주십시오.");
	}
 ?>
 