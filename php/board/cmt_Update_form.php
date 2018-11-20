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
			require_once("cmt_CmtDao.php");

			$num = requestValue("num");
			$page = requestValue("page");
			$cmtnum = requestValue("cmtnum");
			$dao = new CmtDao();
			$cmsg = $dao->getCmsg($cmtnum);
			if($id == "admin"){
			}else if($id != $cmsg["id"]){
				errorBack("틀린 아이디 입니다.");
			}
		?>
		<div class="board">
			<div class="page-header">
				<h2>댓글 수정</h2>
			</div>
			<div class="container">
				<form action="cmt_Update.php?num=<?=$num?>&page=<?=$page?>&cmtnum=<?=$cmsg["num"]?>" method="post">
					<div class="form-group">
						<textarea class="form-control" id="cmt" name="cmt" style="height: 200px" required><?= $cmsg['cmt'] ?></textarea>
					</div>
					<button class="btn btn-primary" type="submit">댓글등록</button>
					<button class="btn btn-primary" type="button" onclick="location.href='<?= bdUrl("board_View.php", $num, $page) ?>'">수정취소</button>
				</form>
			</div>
		</div>
		<?php require("../footer_fixed.php") ?>
</body>
</html>