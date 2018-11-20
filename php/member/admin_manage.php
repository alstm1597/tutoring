<!DOCTYPE html>
<html>
<head>
	<?php require("../html_head.php") ?>
	<style>
	a:hover {
		text-decoration: none
	}
</style>
<script>
	function processadminDelete(a){
		res = confirm("탈퇴시킬꼬야?");
		if(res){
			alert("바이바이");
			location.href="/site3/member/admin_delete.php?mid="+a;
		}
	}
	<?php
	require_once("../tools.php");
	require_once("MemberDao.php");

	$page = requestValue("page");

	define("NUM_LINES", 30);
	define("NUM_PAGE_LINKS", 5);	

	$dao = new MemberDao();
	$numMsgs = $dao->getNumMsgs();

	if($numMsgs > 0 ){
		$numPages = ceil($numMsgs / NUM_LINES);

		if($page < 1)
			$page = 1;
		if($page > $numPages)
			$page = $numPages;
		
		$start = ($page - 1) * NUM_LINES;
		$msgs = $dao->getManyMsgs($start, NUM_LINES);

		$firstLink = floor(($page - 1) / NUM_PAGE_LINKS) * NUM_PAGE_LINKS + 1;
		$lastLink = $firstLink + NUM_PAGE_LINKS - 1;
		if($lastLink > $numPages)
			$lastLink = $numPages;
	}
	if($lastLink > $numPages)
		$lastLink = $numPages;

	?>
</script>
</head>
<body>
	<?php
	require("../header.php");
	require("../sidebar.php");
	if($id != "admin")
		okGo("잘못된 접근입니다.", MAIN_PAGE);
	?>
	<div class="board">
		<div class="page-header">
			<h2>회원관리</h2>
		</div>
		<div class="container; text-center">
			<?php if ($numMsgs > 0) : ?>
				<table class="table table-hover">
					<tr>
						<th>Id</th>
						<th>Pw</th>
						<th>Name</th>
						<th>가입날</th>
						<th>회원수정</th>
						<th>회원탈퇴</th>
					</tr>
					<?php foreach($msgs as $msg) : ?>
						<tr>
							<td><?= $msg["id"] ?></td>
							<td><?= $msg["pw"] ?></td>
							<td><?= $msg["name"] ?></td>
							<td><?= $msg["regtime"] ?></td>
							<td>
								<input type="submit" value="수정" class="btn btn-primary" onclick="location.href = '<?= MEMBER_PATH ?>/admin_manage_update_form.php?id=<?= $msg["id"] ?>'">
							</td>
							<td>
								<button class="btn btn-danger" onclick="processadminDelete('<?= $msg["id"] ?>')">탈퇴</button>
							</td>
						</tr>
					<?php endforeach ?>
				</table>
				
				<br><br>

				<?php if($firstLink > 1) : ?>
					<a href="<?= bdUrl("board_Board.php", 0, 1) ?>"><<</a>&nbsp;
				<?php endif ?>

				<?php if($page > 1) : ?>
					<a href="<?= bdUrl("board_Board.php", 0, $firstLink - NUM_PAGE_LINKS)  ?>"><</a>&nbsp;
				<?php endif ?>
				
				<?php for($i = $firstLink; $i <= $lastLink; $i++) : ?>
					<a href="<?= bdUrl("board_Board.php", 0, $i) ?>">
						<?php if($i == $page) : ?>
							<b><?= $i ?></b></a>&nbsp;
							<?php else : ?>
								<?= $i ?></a>&nbsp;
							<?php endif ?>
						</a>
					<?php endfor ?>

					<?php if($page < $numPages) : ?>
						<a href="<?= bdUrl("board_Board.php", 0, $lastLink + 1) ?>">></a>&nbsp;
					<?php endif ?>

					<?php if($lastLink < $numPages) : ?>
						<a href="<?= bdUrl("board_Board.php", 0, $numPages) ?>">>></a>
					<?php endif ?>
				<?php endif ?>
			</div>
		</div>
		<?php require("../footer.php") ?>
	</body>
	</html>