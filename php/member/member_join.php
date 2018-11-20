	<?php
		require_once("../tools.php");
		require_once("MemberDao.php");
		//requestValue로부터 id 값 읽어오기
		//$id = isset($_REQUEST["id"])?$_REQUEST["id"]:"";
		$id = requestValue("id");
		//requestValue로부터 pw 값 읽어오기
		$pw = requestValue("pw");
		//requestValue로부터 name 값 읽어오기
		$name = requestValue("name");
		
		//모든 입력란이 채워져 있고, 사용중인 아이디가 아니라면 회원정보 추가
		if($id && $pw && $name){
			$mdao = new MemberDao();
			if($mdao->getMember($id)){
				//이미 사용중인 아이디라면 에러메시지 출력후 회원가입 페이지 이동
				//Javascript 코드로 Web browser에게 전송
				errorBack('이미 사용중인 아이디 입니다.');
				exit();
			}else{
				//데이터베이스 회원정보 insert "가입이 완료되었습니다" 라는 메시지 출력 후, 메인 페이지 이동
				$mdao->insertMember($id, $pw, $name);
				okGo("가입이 완료되었습니다.", MAIN_PAGE);
			}
		}else{
			errorBack("모든칸을 입력해 주십시오.");
		}
	 ?>