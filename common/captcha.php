<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-6-1
 * Time: 下午10:44
 */
/**
 * 用于生成验证码的脚本，页面上添加<img src='../common/captcha.php' /> 即可显示图像
 * 同时sha1算法加密过的验证码会被保存在$_SESSION['captcha_phrase']中
 */
session_start();

define('CAPTCHA_NUMCHARS', 4);
define('CAPTCHA_WIDTH', 70);
define('CAPTCHA_HEIGHT', 25);
define('RANDOM_LINENUM', 5);
define('RANDOM_DOTNUM', 50);

//随机生成4个数字
$captcha_phrase = "";
for($i = 0; $i < CAPTCHA_NUMCHARS; $i++) {
    $captcha_phrase .= chr(rand(48, 57));
}

//设置全局变量 sha1加密保存的验证码
$_SESSION['captcha_phrase'] = sha1($captcha_phrase);

$img = imagecreatetruecolor(CAPTCHA_WIDTH, CAPTCHA_HEIGHT);

$bg_color = imagecolorallocate($img, 255, 255, 255); //white

$text_color = imagecolorallocate($img, 0, 0, 0); //black
$graphic_color = imagecolorallocate($img, 64, 64, 64); //dark gray

//Fill the background
imagefilledrectangle($img, 0, 0, CAPTCHA_WIDTH, CAPTCHA_HEIGHT, $bg_color);

for($i = 0; $i < RANDOM_LINENUM; $i++) {
    imageline($img, 0, rand() % CAPTCHA_HEIGHT, CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $graphic_color);
}

for($i = 0; $i < RANDOM_DOTNUM; $i++) {
    imagesetpixel($img, rand() % CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $graphic_color);
}

//imagestring($img, 5, 5, 5, $captcha_phrase, $text_color);
imagettftext($img, 18, 0, 5, CAPTCHA_HEIGHT - 5, $text_color, './LiberationMono-BoldItalic.ttf', $captcha_phrase);

header("Content-type: image/png");
imagepng($img);

imagedestroy($img);
?>
