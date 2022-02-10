<?php
require_once dirname(__FILE__)."/ch-SermonDAO.php";
require_once('../wp-load.php');
require_once('../wp-includes/pluggable.php');

if ( is_user_logged_in() ) 
{
	$current_user = wp_get_current_user();
    //echo 'Welcome! '.$current_user->user_firstname.' '.$current_user->user_lastname ;
	/*
	 echo 'Username: ' . $current_user->user_login . '<br />';
    echo 'User email: ' . $current_user->user_email . '<br />';
    echo 'User first name: ' . $current_user->user_firstname . '<br />';
    echo 'User last name: ' . $current_user->user_lastname . '<br />';
    echo 'User display name: ' . $current_user->display_name . '<br />';
    echo 'User ID: ' . $current_user->ID . '<br />';
	*/
} 
else 
{

    echo "Welcome, visitor! Please login website for admin function <BR><BR>";
	echo "<a href='../wp-login.php'>Go back to login page.</a>";
	exit();
}

$TheSermonApp= new sermonApp;
$TheSermonInfo= new sermonInfo;

/*
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  $selectedId= $_POST['sermonid']; 
  header("Location: ch-SermonUpdate.php?sermonid=");
  exit();
	
}
*/

$TheSermonList=$TheSermonApp->ListSermon();	


?>
<html>
 <head>
   
    <meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    <meta name='description' content=''>
    <meta name='author' content=''>
    <script src='./js/jquery-1.10.2.js'></script>
	<script src='./js/json2.js'></script>
	<script src='./js/bootstrap.min.js'></script>
    <link rel='shortcut icon' href=''>
	<link href='./css/bootstrap.css' rel='stylesheet'>
	
    <title>Create Sermon</title>
	<style>
		.fielderror {color: #FF0000;}
	</style>
</head>
<body>
<div align="center">
<h2>修改錄音證道-選取證道錄音</h2>
<BR>

<form method="post" action="ch-SermonUpdate.php" class="form-inline">
<select name="sermonid" class="form-control input-lg" >
<?php
	$icounter=0;
	$sermondate_01='1900';
	$row_cnt = $TheSermonList->num_rows;
	//echo "==>".$row_cnt;
	while($icounter<$row_cnt) 
		{
			$TheSermon = mysqli_fetch_assoc($TheSermonList);
			$sermondate_00=substr($TheSermon["sermondate"],0,4);
			if ($sermondate_00!=$sermondate_01)
				{
					if ($icounter==0)
					{
						echo "<optgroup label='".htmlspecialchars($sermondate_00)." Year";
						echo " -------------------------------------'>";
					}
					else
					{
						echo "</optgroup><optgroup label='".htmlspecialchars($sermondate_00)." Year";
						echo " -------------------------------------'>";
					}
					
				}
			echo "<option value='".htmlspecialchars($TheSermon["id"])
				."'>[".htmlspecialchars($TheSermon["sermondate"])
				."]".htmlspecialchars($TheSermon["topic"])
				."</option>";
			
			$sermondate_01=substr($TheSermon["sermondate"],0,4);
			$icounter=$icounter+1;
		}
		echo "</optgroup>";
?>	
	</select>
	<input type="submit" name="submit" value="Select" class="btn btn-info">
	<BR><BR>
	<input type="button" onclick="history.back()" value="Go Back" class="btn btn-warning"></input>
</form>
</div>

</body>
</html>
