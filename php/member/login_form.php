<!DOCTYPE html>
<html>
<head>
	<?php require("../html_head.php") ?>
</head>
<body>
		<?php require("../header.php") ?>
		<?php require("../sidebar.php") ?>
		<div class="board">
			<div class="page-header">
				<h2>로그인</h2>
			</div>
			<div class="container">
			  <form action="login.php" method="post">
			    <div class="form-group">
			      <label for="usr">ID</label><!-- 사용중인 아이디일 경우 회원가입 X -->
			      <input type="text" class="form-control" id="usr" name="id">
			    </div>
			    <div class="form-group">
			      <label for="pwd">Password</label>
			      <input type="password" class="form-control" id="pwd" name="pw">
			    </div>
			    <button type="submit" class="btn btn-primary">Login</button>
			  </form>
			</div>
		</div>
		<?php require("../footer.php") ?>
</body>
</html>