
<?php
require_once dirname(__FILE__)."/ch-SermonDAO.php";

$TheSermonApp= new sermonApp;
if (!empty($_GET))
	{
		$TheSermonYear=$_GET["SermonYear"];
		if (isset($TheSermonYear))
			{
				$TheSermonList=$TheSermonApp->ListSermonByYear($TheSermonYear);
			}
	}
else
	{
		$TheSermonYear="2011";
		$TheSermonList=$TheSermonApp->ListSermonByYear($TheSermonYear);		
	}

?>
<html>
 <head>
   
    <meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    <meta name='description' content=''>
    <meta name='author' content=''>
    <script src='./ch-js/jquery-1.10.2.js'></script>
	<script src='./ch-js/json2.js'></script>
	<script src='./ch-js/bootstrap.min.js'></script>
    <link rel='shortcut icon' href=''>
	
    <title>Sermon List</title>
</head>
<body>
<H2>Sermon List for 
<?php
 echo htmlspecialchars($TheSermonYear); 
?>
</H2>
<table class="table table-striped table-hover borderless">
<tbody>
<?php
	$icounter=0;
	while($TheSermon = mysqli_fetch_assoc($TheSermonList)) 
		{
			echo "<tr><td class='vn'>".htmlspecialchars($TheSermon["sermondate"]).":".htmlspecialchars($TheSermon["speaker"])."</td> <td class='v b5'>".htmlspecialchars($TheSermon["topic"])."</td></tr>";
			$icounter=$icounter+1;
		}
?>
</tbody>
</table>
</body>
</html>