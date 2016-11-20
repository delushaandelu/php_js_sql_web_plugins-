<?php
session_start();
if(isset($_POST['submit']) && !empty($_POST['submit'])){
    if(!empty($_POST['captcha_code'])){
		
		//get captcha code from session
        $captchaCode = $_SESSION['captchaCode'];
		
		//get captcha code from input field
        $enteredcaptchaCode = $_POST['captcha_code'];
		
		//verify the captcha code
        if($enteredcaptchaCode === $captchaCode){
            $succMsg = 'Entered captcha code has matched.';
        }else{
            $errMsg = 'Captcha code not matched, please try again.';
        }
		
    }else{
        $errMsg = 'Please enter the captcha code.';
    }
}
?>

<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8" />
<title>Simple PHP Captcha by CodexWorldCaptcha</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
<?php if(!empty($errMsg)) echo '<p style="color:#EA4335;">'.$errMsg.'</p>';?>
<?php if(!empty($succMsg)) echo '<p style="color:#34A853;">'.$succMsg.'</p>';?>

<img src="captcha.php" id="capImage"/>
<br/>Can't read the image? click here to  <a href="javascript:void(0);" onclick="javascript:$('#capImage').attr('src','captcha.php');">refresh</a>.
<form method="post">
	<br/>Enter the code: <input name="captcha_code" type="text" value="">
	<input type="submit" name="submit" value="SUBMIT">
</form>
</body>
</html>