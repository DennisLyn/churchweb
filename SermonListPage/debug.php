<?php
require_once dirname(__FILE__)."/ch/ch-SermonDAO.php";
//require_once dirname(__FILE__)."/ch-SermonDAO.php";

$TheSermonApp= new sermonApp;
$TheYear="2011";
$TheURL="https://s3-us-west-1.amazonaws.com/chinese-church/restructure_sermon/";
if (!empty($_GET))
	{
		$TheSermonYear=$_GET["SermonYear"];
		if (isset($TheSermonYear))
			{
				$TheSermonList=$TheSermonApp->ListSermonByYear($TheSermonYear);
			}
		else
			{
				$TheSermonYear=$TheYear;
				$TheSermonList=$TheSermonApp->ListSermonByYear($TheSermonYear);	
			}
	}
else
	{
		$TheSermonYear=$TheYear;
		$TheSermonList=$TheSermonApp->ListSermonByYear($TheSermonYear);		
	}

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
SermonYear=? <BR>
<!--Content Start-->
[vc_row row_type="row" use_row_as_full_screen_section="no" type="full_width" angled_section="no" text_align="left" background_image_as_pattern="without_pattern" css_animation=""][vc_column][vc_row_inner row_type="row" type="full_width" text_align="left" css_animation=""][vc_column_inner][service_table title="2011 講道錄音" title_tag="h2" title_background_type="background_color_type"]

<ul>
<?php
	$icounter=0;
	while($TheSermon = mysqli_fetch_assoc($TheSermonList)) 
	{
		echo "<li>"
.htmlspecialchars($TheSermon["sermondate"])
."&nbsp;"
.htmlspecialchars($TheSermon["topic"])
."<br/>"
.htmlspecialchars($TheSermon["section"])
."<br/>"
.htmlspecialchars($TheSermon["speaker"])
."<a id='mbmaplayer_1485831241452' class='mb_map {skin:'black', animate:true, width:'160', volume:0.2, autoplay:false, loop:false, showVolumeLevel:true, showTime:true, allowMute:true, showRew:true, addGradientOverlay:false, downloadable:false, downloadablesecurity:false, id3: false}' href='"
.htmlspecialchars($TheURL)
.$TheYear
."/"
.htmlspecialchars($TheSermon["audiofile"])
."'>"
.htmlspecialchars($TheSermon["topic"])
."</a><a class='map_excluded' href='"
.htmlspecialchars($TheURL)
.$TheYear
."/"
.htmlspecialchars($TheSermon["audiofile"])
."' target='Blank'>▼下載</a>"
."</li>";
$icounter=$icounter+1;
	}
?>
</ul>

[/service_table][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row row_type="row" use_row_as_full_screen_section="no" type="grid" angled_section="no" text_align="left" background_image_as_pattern="without_pattern" padding_top="87" padding_bottom="0" css_animation=""][vc_column][vc_column_text]
<!--// Content End-->