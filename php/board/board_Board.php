<?php 
	require_once("../tools.php");
	require_once("board_BoardDao.php");

	//전달된 페이지 번호 저장
	$page = requestValue("page");

	define("NUM_LINES", 10);			//게시글 리스트의 줄수
	define("NUM_PAGE_LINKS", 5);	//화면에 표시될 페이지 링크의 수

	//게시판의 전체 게시글 수 구하기
	$dao = new BoardDao();
	$numMsgs = $dao->getNumMsgs();

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
		$msgs = $dao->getManyMsgs($start, NUM_LINES);

		//페이지네이션 컨트롤의 처음/마지막 페이지 링크 번호 계산
		//floor(($page - 1)/10)
		$firstLink = floor(($page - 1) / NUM_PAGE_LINKS) * NUM_PAGE_LINKS + 1;
		$lastLink = $firstLink + NUM_PAGE_LINKS - 1;
		if($lastLink > $numPages)
			$lastLink = $numPages;
	}
	if($lastLink > $numPages)
			$lastLink = $numPages;
	//현재 로그인한 사용자 아이디 저장( 로그아웃 상태이면 빈 문자열 )

	// if(isset($_SESSION["uid"]))
	// 	$logId = $_SESSION["uid"];
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
				<h2>게시글 리스트</h2>
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
				<form action="board_Search.php" method="post">
					<input type="text" id="search" name="search">
					<input type="submit" value="검색">
				</form>
			</div>

		</div>
		<?php require("../footer.php") ?>
</body>
</html>