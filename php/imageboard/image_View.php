<!DOCTYPE html>
<html>
<head>
	<?php require("../html_head.php") ?>
	<script>
		function processimageDelete(num, page){
			res = confirm("정말로 삭제하시겠습니까?");
			if(res){
				alert("삭제를 완료하였습니다.");
				location.href="image_Delete.php?num="+num+"&page="+page;
			}
		}
		function processCmtDelete(num, page, cmtnum){
			res = confirm("정말로 댓글을 삭제하시겠습니까?");
			if(res){
				alert("삭제를 완료하였습니다.");
				location.href="imagecmt_Delete.php?num="+num+"&page="+page+"&cmtnum="+cmtnum;
			}
		}
	</script>
</head>
<body>
	<?php 

	require("../header.php");
	require("../sidebar.php");
	require_once("../tools.php");
	require_once("image_BoardDao.php");

	$num = requestValue("num");
	$page = requestValue("page");

	$dao = new ImageBoardDao();
	$msg = $dao->getMsg($num);

	?>
	<div class="board">  		
		<div class="page-header">
			<h2>이미지</h2>
		</div>
		<h3><?= $msg["title"] ?></h3><br><br>
		<div style="text-align: center;">
			<?= $msg["content"] ?>
		</div>
		<br>
		<div align="right">
			<button class="btn btn-primary" style="margin-bottom: 20px; margin-right: 20px" onclick="location.href='<?= bdURL("image_Board.php", $num, $page) ?>'">목록보기</button>
			<?php if($id == "admin") : ?>
				<button class="btn btn-primary" style="margin-bottom: 20px; margin-right: 20px" onclick="location.href='<?= bdUrl("image_Update_form.php", $num, $page) ?>'">수정하기</button>
				<button class="btn btn-primary" style="margin-bottom: 20px; margin-right: 20px" onclick="processimageDelete(<?= $num ?>, <?= $page ?>)">삭제하기</button>
			<?php endif ?>
		</div>
		<div class="cmt_board">
			<?php 
			require_once("imagecmt_CmtDao.php");
			define("NUM_CLINES", 1);		
			define("NUM_CPAGE_LINKS", 3);	

			$dao = new ImageCmtDao();
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
											<button class="cmt_btn" onclick="location.href='imagecmt_Update_form.php?num=<?=$num?>&page=<?=$page?>&cmtnum=<?=$cmsg["num"]?>'">수정</button>
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
					<form action="<?= bdurl("imagecmt_Write.php", $num, $page) ?>" method="post">
						<div class="form-group">
							<textarea class="form-control"  id="cmt" name="cmt" required></textarea><br>
							<button class="btn btn-primary" type="submit">댓글달기</button>
						</div>
					</form>
				</div>
			</div>
		</div>	
		<?php require("../footer.php") ?>
	</body>
	</html>