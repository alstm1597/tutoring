<?php 
		require_once("../tools.php");
		require_once("board_BoardDao.php");

		$title = requestValue("title");
		$writer = requestValue("writer");
		$content = requestValue("content");
		$id = requestValue("id");

		if($title && $writer && $content && $id){
			$dao = new BoardDao();
			$dao->insertMsg($title, $writer, $content, $id);
			okGo("정상적으로 입력되었습니다.", "board_Board.php");
		}else{
			errorBack("다시 입력하십시오.");
		}

 ?>