<img src="/site3/tpimg/logo.png" 
	style="position:absoulte;
	display:block;
    margin-left:auto;
    margin-right:auto;
">
<br>
<?php
	require_once("tools.php");

	session_start();

	$id = sessionVar("uid");
	$name = sessionVar("uname");
?>
<script>
	function processDelete(){
		res = confirm("정말로 탈퇴하시겠습니까?");
		if(res){
			alert("탈퇴가 완료하였습니다.");
			location.href="/site3/member/member_delete.php"
		}
	}
</script>
<?php if($name){ ?>
<div class="box">
	<h3><?= $name ?>님 환영합니다.</h3>
	<input id="btnzz" type="submit" value="로그아웃" class="btn btn-danger" onclick="location.href = '<?= MEMBER_PATH ?>/logout.php'">
	<input type="submit" value="회원수정" class="btn btn-primary" onclick="location.href = '<?= MEMBER_PATH ?>/member_update_form.php'">
	<?php if($id != "admin") : ?>
		<input type="submit" value="회원탈퇴" class="btn btn-danger" onclick="processDelete()">
	<?php else : ?>
		<input id="btnzz" type="submit" value="회원관리" class="btn btn-primary" onclick="location.href = '<?= MEMBER_PATH ?>/admin_manage.php'">
	<?php endif ?>
</div>
<?php }else{ ?>
<div class="box">
	<form action="<?= MEMBER_PATH ?>/login.php" method="post">
	    <input type="text" style="margin-left: 18px" size="20" id="usr" name="id" placeholder="ID">
	    <input type="password" size="20" id="pwd" name="pw" placeholder="****">
		<input type="submit" class="btn btn-primary" value="로그인">
		<input type="button" value="회원가입" class="btn btn-primary" onclick="location.href = '<?= MEMBER_PATH ?>/member_join_form.php'">
	</form>
</div>
<?php } ?>
<br><br>
