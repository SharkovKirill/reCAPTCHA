<?php
$width = 150;
$height = 80;
$noise_level = 1000;
$line_length = 8;
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$code = substr(str_shuffle($permitted_chars), 1, $line_length);

//save it in SESSION for furhter form validation
session_start();
$_SESSION["captcha_code"]=$code;
  
$img = imagecreatetruecolor($width, $height);
$bg = imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255)); //background color
$fg = imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));//text color
$ns = imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));//noise color

imagefill($img, 0, 0, $bg);
imagestring($img, 5, 40, 30,  $code, $fg);
// 5 шрифт, 30 30 координаты начала строки
 
// Add some noise to the image.
for ($i = 0; $i < $noise_level; $i++) {
	imagesetpixel($img, rand(0, $width), rand(0, $height), $ns);
}

header("Cache-Control: no-cache, must-revalidate");
header("Content-type: image/png");
imagepng($img);
?>