<!DOCTYPE html>
<html>
<head>
	<?php require("../html_head.php") ?>
	<script>
		function processDelete(num, page){
			res = confirm("정말로 삭제하시겠습니까?");
			if(res){
				alert("삭제를 완료하였습니다.");
				location.href="board_Delete.php?num="+num+"&page="+page;
			}
		}
		function processCmtDelete(num, page, cmtnum){
			res = confirm("정말로 댓글을 삭제하시겠습니까?");
			if(res){
				alert("삭제를 완료하였습니다.");
				location.href="cmt_Delete.php?num="+num+"&page="+page+"&cmtnum="+cmtnum;
			}
		}
	</script>
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
	$dao->increaseHits($num);
	$msg = $dao->getMsg($num);

	?>
	<div class="board">
		<div class="page-header">
			<h2>게시글</h2>
		</div>
		<div class="table">
			<table>
				<tr>
					<th>제목</th>
					<td><?= $msg["title"] ?></td>
				</tr>
				<tr>
					<th>작성자</th>
					<td><?= $msg["writer"] ?></td>
				</tr>
				<tr>
					<th>작성일</th>
					<td><?= $msg["regtime"] ?></td>
				</tr>
				<tr>
					<th>조회수</th>
					<td><?= $msg["hit"] ?></td>
				</tr>
				<tr>
					<th>내용</th>
					<td><?= $msg["content"] ?></td>
				</tr>
			</table>
			<div align="right">
				<button class="btn btn-primary" style="margin-bottom: 20px; margin-right: 20px" onclick="location.href='<?= bdURL("board_Board.php", $num, $page) ?>'">목록보기</button>
				<?php if($id == "admin" || $id == $msg["id"]) : ?>
					<button class="btn btn-primary" style="margin-bottom: 20px; margin-right: 20px" onclick="location.href='<?= bdUrl("board_Update_form.php", $num, $page) ?>'">수정하기</button>
					<button class="btn btn-primary" style="margin-bottom: 20px; margin-right: 20px" onclick="processDelete(<?= $num ?>, <?= $page ?>)">삭제하기</button>
				<?php endif ?>
			</div>
			<div class="cmt_board">
				<?php 
				require_once("cmt_CmtDao.php");
				define("NUM_CLINES", 1);		
				define("NUM_CPAGE_LINKS", 3);	

				$dao = new CmtDao();
				$numCmsgs = $dao->getNumCmsgs($num);
				$cpage = 1;
				$numCpages = 0;
				$lastLink = 0;
				if($numCmsgs > 0 ){
					$numCpages = ceil($numCmsgs / NUM_CLINES);

					if($cpage < 1)
						$cpage = 1;
					if($cpage > $numCpages)
						$cpage = $numCpages;

					$start = ($cpage - 1) * NUM_CLINES;
					$cmsgs = $dao->selectCmt($num);

					$firstLink = floor(($cpage - 1) / NUM_CPAGE_LINKS) * NUM_CPAGE_LINKS + 1;
					$lastLink = $firstLink + NUM_CPAGE_LINKS - 1;
					if($lastLink > $numCpages)
						$lastLink = $numCpages;
				}
				if($lastLink > $numCpages)
					$lastLink = $numCpages;
				?>
				<div class="container; text-center">
					<?php if ($numCmsgs > 0) : ?>						
						<?php foreach($cmsgs as $cmsg) : ?>
							<table class="table">
								<tr class="cmt_tr">
									<th class="cmt_th">
										<?= $cmsg["name"] ?>
									</th>
								</tr>
								<tr>
									<td class="cmt_td">
										<?= $cmsg["cmt"] ?>
										<?php if($id == "admin" || $id == $cmsg["id"]) : ?>
											<div align="right">
												<button class="cmt_btn" onclick="location.href='cmt_Update_form.php?num=<?=$num?>&page=<?=$page?>&cmtnum=<?=$cmsg["num"]?>'">수정</button>
												<button class="cmt_btn"  onclick="processCmtDelete(<?= $num ?>, <?= $page ?>, <?= $cmsg["num"] ?>)">삭제</button>
											</div>
										<?php endif ?>
									</td>
								</tr>
							</table>
						<?php endforeach ?>
						
						<?php if($firstLink > 1) : ?>
							<a href="<?= bdUrl("board_View.php", $num, 1) ?>"><<</a>&nbsp;
						<?php endif ?>

						<?php if($cpage > 1) : ?>
							<a href="<?= bdUrl("board_View.php", $num, $firstLink - NUM_CPAGE_LINKS)  ?>"><</a>&nbsp;
						<?php endif ?>
						
						<?php for($i = $firstLink; $i <= $lastLink; $i++) : ?>
							<a href="<?= bdUrl("board_View.php", $num, $i) ?>">
								<?php if($i == $cpage) : ?>
									<b><?= $i ?></b></a>&nbsp;
									<?php else : ?>
										<?= $i ?></a>&nbsp;
									<?php endif ?>
								</a>
							<?php endfor ?>

							<?php if($cpage < $numCpages) : ?>
								<a href="<?= bdUrl("board_View.php", $num, $lastLink + 1) ?>">></a>&nbsp;
							<?php endif ?>

							<?php if($lastLink < $numCpages) : ?>
								<a href="<?= bdUrl("board_View.php", $num, $numPages) ?>">>></a>
							<?php endif ?>
						<?php endif ?>
					</div>
					<div class="comment" align="right">
						<form action="<?= bdurl("cmt_Write.php", $num, $page) ?>" method="post">
							<div class="form-group">
								<textarea class="form-control"  id="cmt" name="cmt" required></textarea><br>
								<button class="btn btn-primary" type="submit">댓글달기</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<?php 
			$page = requestValue("page");

			define("NUM_LINES", 10);		
			define("NUM_PAGE_LINKS", 5);	

			$dao = new BoardDao();
			$numMsgs = $dao->getNumMsgs();

			if($numMsgs > 0 ){
				$numPages = ceil($numMsgs / NUM_LINES);

				if($page < 1)
					$page = 1;
				if($page > $numPages)
					$page = $numPages;

				$start = ($page - 1) * NUM_LINES; //첫 줄의 레코드 번호
				$msgs = $dao->getManyMsgs($start, NUM_LINES);

				$firstLink = floor(($page - 1) / NUM_PAGE_LINKS) * NUM_PAGE_LINKS + 1;
				$lastLink = $firstLink + NUM_PAGE_LINKS - 1;
				if($lastLink > $numPages)
					$lastLink = $numPages;
			}
			if($lastLink > $numPages)
				$lastLink = $numPages;
			?>
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
											<a href="board_board.php?page=<?= $page ?>" onclick="alert('궁금하면 로그인을 하십시오.')"><?= $msg["title"] ?></a>
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
