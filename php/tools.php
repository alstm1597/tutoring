<?php
	define("MAIN_PAGE", "/site3/index.php");
	define("MEMBER_PATH", "/site3/member");

	function requestValue($arg){
		return isset($_REQUEST["$arg"])?$_REQUEST["$arg"]:"";
	}

	function sessionVar($arg){
		return isset($_SESSION["$arg"])?$_SESSION["$arg"]:"";
	}

	function errorBack($msg){
		
	?>
		<script>
			alert('<?= $msg ?>');
			history.back();
		</script>
		<?php
			exit();
		}
		
		function okGo($msg, $url){
		?>
			<script>
				alert('<?= $msg ?>');
				location.href = '<?= $url ?>';
			</script>
		<?php
			exit();
		}

		function goNow($url){
		?>
			<script>
				location.href = '<?= $url ?>'
			</script>
		<?php
			exit();
		}

		function bdUrl($file, $num, $page){

			//bdUrl("view.php",1,5)
			$join = "?";

			if($num){
				$file .= $join . "num=$num"; //view.php?num=1
				$join = "&";
			}

			if($page)
				$file .= $join . "page=$page";	//view.php?num=1&.page=5
			
			return $file;
			//
		}
		function cmtUrl($file, $num, $page , $cpage){

			//bdUrl("view.php",1,5)
			$join = "?";

			if($num){
				$file .= $join . "num=$num"; //view.php?num=1
				$join = "&";
			}

			if($page){
				$file .= $join . "page=$page";
				$join = "&";	//view.php?num=1&.page=5
			}
			if($page)
				$file .= $join . "cpage=$cpage";
			
			return $file;
			//
		}
		function srUrl($file, $num, $page, $sr){

			//bdUrl("view.php",1,5)
			$join = "?";

			if($num){
				$file .= $join . "num=$num"; //view.php?num=1
				$join = "&";
			}

			if($page){
				$file .= $join . "page=$page";	//view.php?num=1&.page=5
				$join = "&";
			}
			if($sr)
				$file .= $join . "search=$sr";
			
			return $file;
			//
		}

?>