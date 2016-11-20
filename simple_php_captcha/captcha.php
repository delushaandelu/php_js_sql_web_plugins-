<?php
include 'CodexWorldCaptcha.php';
$captchaConfig = array(
     'img_width' => '200',
     'img_height' => '50',
     'font_size' => '30',
     'font_path' => 'fonts/monofont.ttf',
 );
$captcha = new CodexWorldCaptcha($captchaConfig);
$captcha->createCaptcha();
?>