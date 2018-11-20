<?php 
		session_start();
		require_once("../tools.php");
		require_once("imagecmt_CmtDao.php");

		$id = sessionVar("uid");
		$name = sessionVar("uname");

		$bdnum = requestValue("num");
		$cmt = requestValue("cmt");
		$page = requestValue("page");

		if($id && $name && $bdnum && $cmt){
			//DB에 insert
			$dao = new ImageCmtDao();
			$dao->insertCmsg($id, $name, $bdnum, $cmt);
			goNow(bdUrl("image_View.php", $bdnum, $page));
		}else{
			errorBack("다시 입력하십시오.");
		}

 ?>