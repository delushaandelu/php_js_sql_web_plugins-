<?php
//start session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login with LinkedIn using PHP by CodexWorld</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>

<body>

<?php
if(isset($_SESSION["loggedin_user_id"]) && !empty($_SESSION["user"])) 
{
	$user = $_SESSION["user"];
	?>
	<div class="login-form">
        <div class="head">
            <img src="<?php echo $user->pictureUrl; ?>" alt=""/>
            
        </div>
        <form>
        <li>
            <p><?php echo $user->formattedName; ?></p>
        </li>
        <li>
            <p><?php echo $user->emailAddress; ?></p>
        </li>
        <li>
            <p><?php echo $user->location->name; ?></p>
        </li>
        <div class="p-container">
            <a href="logout.php" class="logout">Logout</a>
            <a href="<?php echo $user->publicProfileUrl; ?>" target="_blank" class="profile">View Profile</a>
            <div class="clear"> </div>
        </div>
        </form>
	</div>
	<?php
}else{
		
	if(isset($_SESSION["err_msg"]) && $_SESSION["err_msg"] <> ""){
		echo $_SESSION["err_msg"];
	}

	//login button
	echo '<div class="linkedin_btn"><a href="process.php"><img src="images/sign-in-with-linkedin.png" /></a></div>';
}

?>  
</body>

</html>