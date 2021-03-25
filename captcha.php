<?php
session_start();
$width = 150;
$height = 80;
$noise_level = 10;
$line_length = 8;
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$captcha_code = substr(str_shuffle($permitted_chars), 1, $line_length);

//create the image resource
$captcha_image = imagecreatetruecolor($width, $height);
$bg = imagecolorallocate($captcha_image, rand(0,255), rand(0,255), rand(0,255)); //background color
$fg = imagecolorallocate($captcha_image, rand(0,255), rand(0,255), rand(0,255));//text color
$ns = imagecolorallocate($captcha_image, rand(0,255), rand(0,255), rand(0,255));//noise color
//fill the image resource with the bg color
imagefill($captcha_image, 0, 0, $bg);

//Random angle
imagettftext($captcha_image, 14, rand(-45,45), 60, 40, $fg, "/home/localhost/www/n/monofont.ttf", $captcha_code);

for ($i = 0; $i < $noise_level; $i++) {
	imagesetpixel($captcha_image, rand(0, $width), rand(0, $height), $ns);
}
//tell the browser that this is an image
header("Cache-Control: no-cache, must-revalidate");
header('Content-type: image/png');
imagejpeg($captcha_image); //showing the image
imagedestroy($captcha_image); //destroying the image instance
$_SESSION['captcha'] = $captcha_code;


?>