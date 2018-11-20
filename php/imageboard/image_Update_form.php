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
			require_once("image_BoardDao.php");


			$num = requestValue("num");
			$page = requestValue("page");

			$dao = new ImageBoardDao();
			$msg = $dao->getMsg($num);

			if($id != "admin")
				okGo("잘못된 접근입니다.", MAIN_PAGE);
		?>
		<div class="board">
			<div class="page-header">
				<h2>게시글 수정</h2>
			</div>
			<div class="container">
				<form action="image_Update.php?num=<?=$num?>&page=<?=$page?>" method="post">
					<div class="form-group">
						<label for="ti">제목</label>
						<input class="form-control" type="text" name="title" id="ti" value="<?= $msg['title'] ?>" required><br>
					</div>
					<div class="form-group">
						<label for="content"><input type="file" name="image_file" id="image_file"></label>
						<textarea class="form-control" id="content" name="content" required><?= $msg['content'] ?></textarea>
					</div>
					<div align="right">
						<button class="btn btn-primary" type="submit">글등록</button>
						<button class="btn btn-primary" type="button" onclick="location.href='<?= bdURL("image_View.php", $num, $page) ?>'">수정취소</button>
					</div>
				</form>
			</div>
		</div>
		<?php require("../footer.php") ?>
</body>
</html>
	<script src="//code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<script>
	$('#image_file').on('change', function(e){
	 //파일들을 변수에 넣고
	 var files = e.target.files;
	 
	 //post방식으로 보내야하기 때문에 form을 생성해줍니다.
	 var data = new FormData();
	 
	 //만약 input에 multiple 속성을 추가한다면, 파일을 여러개 선택할 수 있는데, 저는 일단 1개로
	 //그 때의 파일을 배열로 만들어 주기 위한 작업입니다.
	 $.each(files, function(key, value)
	 {
	  //key는 다른 지정이 없다면 0부터 시작 할것이고, value는 파일 관련 정보입니다.
	  data.append(key, value);
	 });

	  $.ajax({
	         url: 'image_UploadAjax.php?files', //file을 저장할 소스 주소입니다.
	         type: 'POST',
	         data: data, //위에서 가공한 data를 전송합니다.
	         cache: false,
	         dataType: 'json',
	         processData: false, 
	         contentType: false, 
	         success: function(data, textStatus, jqXHR)
	         {
	          if(typeof data.error === 'undefined') //에러가 없다면
	          {
	           //저장된 파일의 정보를 통해 위에서 선언한 img_section이란 곳에 추가 할 코드입니다. 파일이 1개기 때문에 index가 0입니다.
	           var source = '<img src ="'+data.files[0]+'" style="width:350px; height:auto;">'
	           $("#content").html(source);
	          }
	          else//에러가 있다면
	          {
	           console.log('ERRORS: ' + data.error);
	          }
	         },
	         error: function(jqXHR, textStatus, errorThrown)
	         {
	          console.log('ERRORS: ' + textStatus);
	         }
	     });
	     
	 }
	);
	</script>