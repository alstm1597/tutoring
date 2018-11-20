<!DOCTYPE html>
<html>
<head>
	<?php require("html_head.php") ?>
</head>
<body>
	<?php 
		require("header.php");
	 	require("sidebar.php");
	?>
	<div class="board">
		<div class="page-header">
			<h2>소식지</h2>
		</div>
		<?php
			require($_SERVER['DOCUMENT_ROOT'].'/site3/snoopy/Snoopy.class.php');

			$snoopy = new Snoopy;
			
			$snoopy->referer = "http://www.lovelive-anime.jp/otonokizaka/news.php";
			$url = 'http://www.lovelive-anime.jp/otonokizaka/news.php';

			$snoopy->fetch($url);
			preg_match_all('/<iframe(.*?)>(.*?)<\/iframe>/is', $snoopy->results, $text);
			
			for ($i=0; $i < count($text[0]); $i++) {

			 	echo $text[0][$i],"<br>";
			

			 }

		?>
	</div>
	<?php require("footer_fixed.php") ?>
</body>
</html>