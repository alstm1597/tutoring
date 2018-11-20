<!DOCTYPE html>
<html>
<head>
	<?php require("html_head.php") ?>
</head>
<body>
	<?php require("header.php") ?>
	<?php require("sidebar.php") ?>
	<div class="board">
		<h2>여기는 곧 러브라이브 커뮤니티 사이트가 될 거야</h2>
		<video width="640" height="400" controls>
			<source src="media/cyaron.mp4" type="video/mp4">
				브라우저가 video 태그를 지원하지 않습니다.
			</video>
			<br>
			<?php

			require($_SERVER['DOCUMENT_ROOT'].'/site3/snoopy/Snoopy.class.php');

			$snoopy = new Snoopy;
			$snoopy->referer = "http://www.wemakeprice.com/";

			$snoopy->fetch("http://promotion.wemakeprice.com/promotion/bestmenswear/?source=100010_listevtbanner&no=3");

			  preg_match_all('/<div class=\"section\_list section\_ing\" style=\"width\:937px\;margin\:0 auto\;padding\:0\;\">(.*?)<\/div>/is', $snoopy->results, $text);

			  for ($i=0; $i < count($text[0]); $i++) {

			 	echo "<div style='display:inline-block'>",$text[0][$i],"</div>";
			  }	
			 
			

			?>
		</div>
		<?php require("footer.php") ?>
	</body>
	</html>