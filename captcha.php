<?php 
	define('CAPTCHA_SIZE', '6');
	define('CAPTCHA_WIDTH', '100');
	define('CAPTCHA_HEIGHT', '25');
	
	$pass_phrase="";
	for ( $i=0; $i < CAPTCHA_SIZE; $i++) { 
		$pass_phrase.=chr(rand(91,122));
	}
	$_SESSION['pass_phrase']=sha1($pass_phrase);//store avalue in session variable to verify it whenever it is called

	$img=imagecreatetruecolor(CAPTCHA_WIDTH, CAPTCHA_HEIGHT);

	$bg_color=imagecolorallocate($img, 255, 255, 255);//white
	$text_color=imagecolorallocate($img, 0, 0, 0);//black
	$graphic_color=imagecolorallocate($img, 64, 64, 64);//gray

	imagefilledrectangle($img, 0, 0, CAPTCHA_WIDTH, CAPTCHA_HEIGHT, $bg_color);

	//draw some random lines
	for ($i=0; $i <5 ; $i++) { 
		imageline($img, 0,rand()%CAPTCHA_HEIGHT,CAPTCHA_WIDTH,rand()%CAPTCHA_HEIGHT,$graphic_color);
	}

	//sprinkling some dots
	for ( $i=0; $i <50; $i++) { 
		imagesetpixel($img, rand()%CAPTCHA_WIDTH, rand()%CAPTCHA_HEIGHT, $graphic_color);
	}

	imagettftext($img, 18, 0, 5, CAPTCHA_HEIGHT-5, $text_color,"fonts/courbd.ttf",$pass_phrase);
	header("Content-type: image/png");
	imagepng($img);

	//clean-up
	imagedestroy($img);
?>