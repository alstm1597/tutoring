<!DOCTYPE html>
<html>
<head>
	<?php require("../html_head.php") ?>
</head>
<body>
		<?php 
			require("../header.php");
			require("../sidebar.php");
			require_once("../tools.php");
			require_once("board_BoardDao.php");
			require("../member/MemberDao.php");
			$mdao = new MemberDao();
			$check = $mdao->getMember($id);


			$num = requestValue("num");
			$page = requestValue("page");

			if(!$check)
				okGo("잘못된 접근입니다.", MAIN_PAGE);
		?>
		<div class="board">
			<div class="page-header">
				<h2>게시글 쓰기</h2>
			</div>
			<div class="container">
				<form action="board_Write.php" method="post" novalidate>
					<div class="form-group">
						<label for="id">아이디</label>
						<input class="form-control" type="text" name="id" id="id" value="<?= $id ?>" readonly><br>
					</div>
					<div class="form-group">
						<label for="ti">제목</label>
						<input class="form-control" type="text" name="title" id="ti" required><br>
					</div>
					<div class="form-group">
						<label for="wr">작성자</label>
						<input class="form-control" type="text" name="writer" id="wr" value="<?= $name ?>" readonly><br>
					</div>
					<div class="form-group">
						<label for="content">내용</label>
						<textarea id="content" name="content" required></textarea>
						<script type="text/javascript">
							CKEDITOR.replace('content'); 
						</script>
					</div>
					<div align="right">
						<button class="btn btn-primary" type="submit">글등록</button>
						<button class="btn btn-primary" type="button" onclick="location.href='<?= bdURL("board_Board.php", $num, $page) ?>'">목록보기</button>
					</div>
				</form>
			</div>
		</div>
		<?php require("../footer.php") ?>
</body>
</html>