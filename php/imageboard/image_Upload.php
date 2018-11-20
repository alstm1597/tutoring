<?php 
		require_once("../tools.php");
		require_once("image_BoardDao.php");

		$title = requestValue("title");
		$content = requestValue("content");

		if($title && $content){
			//DB에 insert
			$dao = new ImageBoardDao();
			$dao->insertMsg($title, $content);
			okGo("정상적으로 입력되었습니다.", "image_Board.php");
		}else{
			echo $title,$content;
			// errorBack("다시 입력하십시오.");
		}

 ?>