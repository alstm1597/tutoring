<?php 
	require_once("../tools.php");
	require_once("board_BoardDao.php");

	define("NUM_LINES", 10);			//게시글 리스트의 줄수
	define("NUM_PAGE_LINKS", 5);	//화면에 표시될 페이지 링크의 수

	$re = requestValue('search');
	$page = requestValue('page');
	$dao = new BoardDao();
	$numMsgs = $dao->searchWNum($re);

	if($numMsgs > 0 ){
		//전체 페이지 수 구하기
		$numPages = ceil($numMsgs / NUM_LINES);

		//현재 페이지 번호가 (1 ~ 전체 페이지 수)를 벗어나면 보정
		if($page < 1)
			$page = 1;
		if($page > $numPages)
			$page = $numPages;
						
		//리스트에 보일 게시글 데이터 읽기
		$start = ($page - 1) * NUM_LINES; //첫 줄의 레코드 번호
		$msgs = $dao->searchWResult($start, NUM_LINES, $re);

		//페이지네이션 컨트롤의 처음/마지막 페이지 링크 번호 계산
		//floor(($page - 1)/10)
		$firstLink = floor(($page - 1) / NUM_PAGE_LINKS) * NUM_PAGE_LINKS + 1;
		$lastLink = $firstLink + NUM_PAGE_LINKS - 1;
		if($lastLink > $numPages)
			$lastLink = $numPages;
	}
	if($lastLink > $numPages)
			$lastLink = $numPages;
?>
<!DOCTYPE html>
<html>
<head>
	<?php require("../html_head.php") ?>
	<style>
		a:hover {
			text-decoration: none
		}
	</style>
</head>
<body>
		<?php require("../header.php") ?>		
		<?php require("../sidebar.php") ?>
				<div class="board">
			<div class="page-header">
				<h2>검색 결과 총 <?= $numMsgs ?>개의 게시글이 발견 되었습니다.</h2>
			</div>
			<div class="container; text-center">
				<?php if ($numMsgs > 0) : ?>
					<table class="table table-hover">
						<tr>
							<th>번호</th>
							<th>제목</th>
							<th>작성자</th>
							<th>작성일시</th>
							<th>조회수</th>
						</tr>
						 <?php foreach($msgs as $msg) : ?>
						 	<tr>
						 		<td><?= $msg["num"] ?></td>
						 		<?php if($id) : ?>
						 			<td><a href="board_View.php?num=<?= $msg["num"] ?>&page=<?= $page ?>"><?= $msg["title"] ?></a></td>
						 		<?php else : ?>
						 			<td>
						 				<a href="board_Board.php?page=<?= $page ?>" onclick="alert('궁금하면 로그인을 하십시오.')"><?= $msg["title"] ?></a>
						 			</td>
						 		<?php endif ?>
						 		<td><?= $msg["writer"] ?></td>
						 		<td><?= $msg["regtime"] ?></td>
						 		<td><?= $msg["hit"] ?></td>
						 	</tr>
						<?php endforeach ?>
					</table>
					
					<?php if($id) : ?>
						<div class="float-right" style="margin-right: 50px">
							<button class="btn btn-primary" onclick="location.href='board_Write_form.php?num=<?= $msg["num"] ?>&page=<?= $page ?>'">글쓰기</button>
						</div>
					<?php endif ?>

					<br><br>

					<?php if($firstLink > 1) : ?>
						<a href="<?= srUrl("board_Search.php", 0, 1, $re) ?>"><<</a>&nbsp;
					<?php endif ?>

					<?php if($page > 1) : ?>
						<a href="<?= srUrl("board_Search.php", 0, $firstLink - NUM_PAGE_LINKS, $re)  ?>"><</a>&nbsp;
					<?php endif ?>
					          
					<?php for($i = $firstLink; $i <= $lastLink; $i++) : ?>
						<a href="<?= srUrl("board_Search.php", 0, $i, $re) ?>">
							<?php if($i == $page) : ?>
									<b><?= $i ?></b></a>&nbsp;
							<?php else : ?>
									<?= $i ?></a>&nbsp;
							<?php endif ?>
						</a>
					<?php endfor ?>

					<?php if($page < $numPages) : ?>
						<a href="<?= srUrl("board_Search.php", 0, $lastLink + 1, $re) ?>">></a>&nbsp;
					<?php endif ?>

					<?php if($lastLink < $numPages) : ?>
						<a href="<?= srUrl("board_Search.php", 0, $numPages, $re) ?>">>></a>
					<?php endif ?>
				<?php endif ?>
				<form action="board_Search.php" method="post">
					<input type="text" id="search" name="search">
					<input type="submit" value="검색">
				</form>
			</div>

		</div>
		<?php require("../footer.php") ?>
</body>
</html>