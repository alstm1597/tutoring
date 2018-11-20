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
			if($id != "admin")
				okGo("잘못된 접근입니다.", MAIN_PAGE);

			$mdao = new MemberDao();

			$mid = requestValue("id");
			$msg = $mdao->getMsg($mid);
		
		 ?>
	<div class="board"> 
		<div class="page-header">
			<h2>회원수정</h2>
		</div>
		<div class="container">
		  <form action="admin_manage_update.php" method="post">
		  	<div class="form-group">
		      <label for="usr">ID</label>
		      <input type="text" class="form-control" readonly value="<?= $msg['id'] ?>" id="usr" name="id">
		    </div>
		    <div class="form-group">
		      <label for="pwd">Password</label>
		      <input type="password" class="form-control" value="<?= $msg['pw'] ?>" id="pwd" name="pw">
		    </div>
		    <div class="form-group">
		      <label for="nam">Name</label>
		      <input type="text" class="form-control" value="<?= $msg['name'] ?>" id="nam" name="name">
		    </div>
		    <button type="submit" class="btn btn-primary">수정</button>
		  </form>
		</div>
	</div>
	<?php require("../footer.php") ?>
</body>
</html>