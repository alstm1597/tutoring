<!DOCTYPE html>
<html>
<head>
	<?php require("../html_head.php") ?>
</head>
<body>
		<?php
			require("../header.php");
		 	require("../sidebar.php"); 
			require_once("MemberDao.php");
			require_once("../tools.php");

			
			$mdao = new MemberDao();
			$member = $mdao->getMember($id);

			if(!$member){
				errorBack("그런 사람은 없습니다.");
				exit();
			}
		 ?>
	<div class="board"> 
		<div class="page-header">
			<h2>회원수정</h2>
		</div>
		<div class="container">
		  <form action="member_update.php" method="post">
		  	<div class="form-group">
		      <label for="usr">ID</label><!-- 사용중인 아이디일 경우 회원가입 X -->
		      <input type="text" class="form-control" readonly value="<?= $member['id'] ?>" id="usr" name="id">
		    </div>
		    <div class="form-group">
		      <label for="pwd">Password</label>
		      <input type="password" class="form-control" value="<?= $member['pw'] ?>" id="pwd" name="pw">
		    </div>
		    <div class="form-group">
		      <label for="name">Name</label>
		      <input type="text" class="form-control" value="<?= $member['name'] ?>" id="nam" name="name">
		    </div>
		    <button type="submit" class="btn btn-primary">수정</button>
		  </form>
		</div>
	</div>
	<?php require("../footer.php") ?>
</body>
</html>