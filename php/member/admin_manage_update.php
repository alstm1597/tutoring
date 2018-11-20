<?php  
		require_once("../tools.php");
		require_once("MemberDao.php");

		$id = requestValue("id");
		$pw = requestValue("pw");
		$name = requestValue("name");

		$mdao = new MemberDao();
		$check = "admin";

		if(!$check){
			okGo("잘못된 접근입니다.", MAIN_PAGE);
		}else if($check && $id && $pw && $name){
			$mdao->updateMember($id, $pw, $name);

			okGo("회원정보 수정이 완료되었습니다", "admin_manage.php");
			exit();
		}else{
			errorBack("모든 칸을 채워주십시오.");
		}
?>