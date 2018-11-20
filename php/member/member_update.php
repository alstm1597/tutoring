<?php  
	/*
		request 정보에서 id, pw, name 추출
		데이터베이스에서 저장된 회원정보 수정
		main 페이지로 이동
	*/
		session_start();

		require_once("../tools.php");
		require_once("MemberDao.php");

		$id = requestValue("id");
		$pw = requestValue("pw");
		$name = requestValue("name");

		// $uid = isset($_SESSION["uid"])?$_SESSION["uid"]:"";
		$uid = sessionVar("uid");
		$mdao = new MemberDao();
		$check = $mdao->getMember($uid);

		if(!$check){
			okGo("잘못된 접근입니다.", MAIN_PAGE);
		}else if($check && $id && $pw && $name){
			$mdao->updateMember($id, $pw, $name);
			$_SESSION["uname"] = $name;

			okGo("회원정보 수정이 완료되었습니다", MAIN_PAGE);
		}else{
			errorBack("모든 칸을 채워주십시오.");
		}
?>