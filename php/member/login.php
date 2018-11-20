<?php 
	/*
		인증(Authentication) vs 권한관리(Authorization)
 		request에서 id, pw추출
		DB에서 그 id와 pw 가진 레코드 있는지 확인하고

			=> id와 pw 값을 가지고 select 해도 되지만
			 : select * from member where id = :id and pw = :pw;
			=> 일반적으로 id값만 가지고 select 해본다.
			 : select * from member where id = $id

		있으면 session에 로그인 했음을 표시하는 정보 기록하고
		main page로 이동
	*/
		session_start();

		require_once("../tools.php");
		require_once("MemberDao.php");
		//requestValue로부터 id 값 읽어오기
		//$id = isset($_REQUEST["id"])?$_REQUEST["id"]:"";
		$id = requestValue("id");
		//requestValue로부터 pw 값 읽어오기
		$pw = requestValue("pw");

		$mdao = new MemberDao();
		$member = $mdao->getMember($id);

		
		if($member && $member["pw"] == $pw){
			//로그인 성공
			//세션에 로그인 성송 정보를 기록 : 어떻게?
			$_SESSION["uid"] = $id;
			$_SESSION["uname"] = $member["name"];
		?>
		<script>
			history.back();
		</script>
<?php
		}else{
			// 로그인 실패
			errorBack("존재하지 않는 계정입니다.");
		}
 ?>