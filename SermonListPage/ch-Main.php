<html>

 <head>

	<meta charset='utf-8'>

	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
	<script src='./js/bootstrap.min.js'></script>
	<link href='./css/bootstrap.css' rel='stylesheet'>

 </head>

 <body>
<?php
require_once('../wp-load.php');
require_once('../wp-includes/pluggable.php');

if ($_GET["Action"]=='logout')
{
	//wp_logout();
	wp_destroy_current_session();
	wp_clear_auth_cookie();
	echo "<div align='center'><BR><BR>";
	echo "<h4>You have logged out. Thank you!</h4><BR><BR>";
	echo "<a href='/' class='btn btn-success btn-lg'  role='button'>Go back to main site.</a><BR<BR>";
	echo "<BR><BR>";
	echo "<a href='../wp-login.php' class='btn btn-primary btn-lg'  role='button'>Go back to login page.</a><BR<BR>";
	echo "</div>";
	exit();
	//cho "Logout";
}
if ( is_user_logged_in() ) 
{
	$current_user = wp_get_current_user();
    //echo 'Welcome! '.$current_user->user_firstname.' '.$current_user->user_lastname ;
} 
else 
{
    echo "Welcome, visitor! Please login website for admin function: <BR><BR>";
	echo "<a href='../wp-login.php'>Go back to login page.</a>";
	exit();
}

?>



 <div align=center>

   <H2>中華歸主海沃教會</H2>

   <h4>Hello! <?php echo $current_user->user_firstname.' '.$current_user->user_lastname.' (WordPress Site Login)' ; ?></h4>
<br><br>
 <form>
    <button type="submit" class="btn btn-primary" formaction="ch-SermonCreate.php">1.新增證道錄音資料 (Create sermon record)</button>
	<br><br>
	<button type="submit" class="btn btn-primary" formaction="ch-SermonUpdateList.php">2.修改證道錄音資料 (Update sermon record)</button>
	<br><br><br><br><br>
	
	<a class="btn btn-warning" href="./ch-Main.php?Action=logout" role="button">登出系統 Log Out</a>
</form>

 

 </div>

 </body>

 </html>