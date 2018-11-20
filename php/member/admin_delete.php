<?php

	require_once("../tools.php");
	require_once("MemberDao.php");

	$mid = requestValue('mid');
	$dao = new MemberDao();
	$check = "admin";

	if(!$check){
		okGo("잘못된 접근입니다.", MAIN_PAGE);
	}else if($check && $mid){
		$dao->deleteMember($mid);

		okGo("회원정보 삭제가 완료되었습니다", "admin_manage.php");
		exit();
	}
 ?>