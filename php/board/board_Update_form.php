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

			$num = requestValue("num");
			$page = requestValue("page");

			$dao = new BoardDao();
			$msg = $dao->getMsg($num);
			if($id == "admin"){

			}else if($id != $msg["id"]){
				errorBack("틀린 아이디 입니다.");
			}
		?>
		<div class="board">
			<div class="page-header">
				<h2>게시글 수정</h2>
			</div>
			<div class="container">
				<form action="<?= bdurl("board_Update.php", $num, $page) ?>" method="post" novalidate>
					<div class="form-group">
						<label for="id">아이디</label>
						<input class="form-control" type="text" name="id" id="id" value="<?= $msg['id'] ?>" readonly ><br>
					</div>
					<div class="form-group">
						<label for="ti">제목</label>
						<input class="form-control" type="text" name="title" id="ti" value="<?= $msg['title'] ?>"><br>
					</div>
					<div class="form-group">
						<label for="wr">작성자</label>
						<input class="form-control" type="text" name="writer" id="wr" value="<?= $msg['writer'] ?>" readonly><br>
					</div>
					<div class="form-group">
						<label for="content">내용</label>
						<textarea class="form-group" id="content" name="content" required><?= $msg['content'] ?></textarea>
						<script type="text/javascript">
							CKEDITOR.replace('content'); 
						</script>
					</div>
					<button class="btn btn-primary" type="submit">글등록</button>
					<button class="btn btn-primary" type="button" onclick="location.href='<?= bdUrl("board_View.php", $num, $page) ?>'">수정취소</button>
				</form>
			</div>
		</div>
		<?php require("../footer.php") ?>
</body>
</html>