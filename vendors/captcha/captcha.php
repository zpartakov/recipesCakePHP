<?php
/*	Captcha Class 1.0
*	Written by Zakir Hyder (http://blog.jambura.com/)
*/
/*error_reporting(2);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');*/
/* 
 * The requested address '/pages/captcha_image'
 * was not found on this server.
 * 
 * */
class captcha {	
	public function show_captcha() {
		if (session_id() == "") {
			session_name("CAKEPHP");
			session_start();
		}

		$path= VENDORS.'captcha';
		$path=preg_replace("/atable20/","atable20/app", $path);
		//echo $path; exit;
		$imgname = 'noise.jpg';
		$imgpath  = $path.'/images/'.$imgname;
		//echo $imgpath; exit;
				
		$captchatext = md5(time());
		$captchatext = substr($captchatext, 0, 5);
		$_SESSION['captcha']=$captchatext;

		if (file_exists($imgpath) ){
			$im = imagecreatefromjpeg($imgpath); 
			//$grey = imagecolorallocate($im, 128, 128, 128);
			$font = $path.'/fonts/'.'BIRTH_OF_A_HERO.ttf';
			
			imagettftext($im, 25, 0, 10, 25, $grey, $font, $captchatext) ;
//			imagettftext($im, 10, 10, 10, 10, $grey, $font, $captchatext) ;
				
			header('Content-Type: image/jpeg');
			header("Cache-control: private, no-cache");
			header ("Last-Modified: " . gmdate ("D, d M Y H:i:s") . " GMT");
			header("Pragma: no-cache");
			imagejpeg($im);
			
			imagedestroy($im);
			ob_flush();
			flush();
		}
		else{
			echo 'captcha error';
			exit;
		}		 
	}
}

 
?>