<?php 
		require_once("../tools.php");
		require_once("image_BoardDao.php");

		$num = requestValue("num");
		$page = requestValue("page");
		$title = requestValue("title");
		$content = requestValue("content");

		if($title && $content){
			//DB에 insert
			$dao = new ImageBoardDao();
			$dao->updateImg($num, $title, $content);
			okGo("게시글이 수정되었습니다.", bdUrl("image_View.php", $num, $page));
		}else{
			errorBack("다시 입력하십시오.");
		}

 ?>