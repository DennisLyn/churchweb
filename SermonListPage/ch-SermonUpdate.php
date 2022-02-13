<html>
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Use bootstrap style for UI layout -->
    <script src="./js/bootstrap.min.js"></script>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <title>Update Sermon</title>
    <style>
      /* TODO: need to create a separated CSS file if custom styles grow up */
      .fielderror {
        color: #FF0000;
      }
    </style>
 </head>
 <body>
 <?php
 require_once dirname(__FILE__).'/ch-SermonDAO.php';
 /**
  * Integrated WordPress functions for user authentication and plugging PHP page into WordPress site
  * Sermon code folder should be added at the same root of the WordPress site
  */
 require_once('../wp-load.php');
 require_once('../wp-includes/pluggable.php');

 if (is_user_logged_in()) {
  $current_user = wp_get_current_user();
 } else {
  echo '<div align="center"><br/><br/>';
  echo '<h4>Looks like there is something wrong with your access. Please re-login again or contact our admin person.</h4><br/><br/>';
  echo '<a href="../wp-login.php" class="btn btn-primary btn-lg" role="button">Go back to login page.</a>';
  echo '</div>';
  echo '</body>';
  exit();
 }

 $TheSermonApp= new SermonApp;
 $TheSermonInfo= new SermonInfo;

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $selectedId = $_POST['sermonid'];
  $TheSermonInfo = $TheSermonApp->getInfoById($selectedId);
  $sermondate = $TheSermonInfo->sermondate;
  $speaker = $TheSermonInfo->speaker;
  $topic = $TheSermonInfo->topic;
  $section = $TheSermonInfo->section;
  $location = $TheSermonInfo->location;
  $remark = $TheSermonInfo->remark;
  $audiofile = $TheSermonInfo->audiofile;
  $bibleID = $TheSermonInfo->bibleID;

  // For update record
  if (isset($_POST['update'])) {
   $errorFlag=0;

   // Form validation
   if (empty($_POST['sermondate']) ) {
    $sermondateErr = 'sermondate is required';
    $errorFlag++;
   } else {
    $sermondate = $_POST['sermondate'];
    $TheSermonInfo->sermondate = $_POST['sermondate'];
   }

   if (empty($_POST['speaker'])) {
    $speakerErr = 'speaker is required';
    $errorFlag++;
   } else {
    $speaker = $_POST['speaker'];
    $TheSermonInfo->speaker = $_POST['speaker'];
   }

   if (empty($_POST['topic'])) {
    $topicErr = 'topic is required';
    $errorFlag++;
   } else {
    $topic = $_POST['topic'];
    $TheSermonInfo->topic = $_POST['topic'];
   }

   $section = $_POST['section'];
   $TheSermonInfo->section = $_POST["section"];

   if (empty($_POST['location'])) {
    $locationErr = 'location is required';
    $errorFlag++;
   } else {
    $location=$_POST['location'];
    $TheSermonInfo->location = $_POST['location'];
   }

   if (empty($_POST['audiofile'])) {
    $audiofileErr = 'audio file name is required';
    $errorFlag++;
   } else {
    $audiofile = $_POST['audiofile'];
    $TheSermonInfo->audiofile = $_POST['audiofile'];
   }

   $bibleID = $_POST['bibleID'];
   $TheSermonInfo->bibleID=$_POST['bibleID'];

   $remark=$_POST["remark"];
   $TheSermonInfo->remark = $_POST["remark"];

   if($errorFlag == 0) {
    $TheSermonInfo->updatedBy = $current_user->user_login;
    $TheSermonInfo->activeFlag = 'Active';
    $TheSermonApp->update($TheSermonInfo);

    echo '<div align="center"><br/><br/>';
    echo '<h4>Sermon updated. Thank you! '.$current_user->user_login.'</h4><br><br>';
    echo '<a href="ch-Main.php" class="btn btn-primary btn-lg"  role="button">Go back to main page.</a><br><br>';
    echo '<a href="/sermon-'.substr($sermondate,0,4).'/" target="_blank" class="btn btn-success btn-lg" role="button">Go to review the update.</a>';
    echo '</div>';
    echo '</body>';
    exit();
   }

  // For delete record
  if (isset($_POST['delete'])) {
   $TheSermonInfo->updatedBy = $current_user->user_login;
   $TheSermonInfo->activeFlag = 'Inactive';
   $TheSermonApp->delete($TheSermonInfo);
   echo 'Sermon is deleted by '.$current_user->user_login.'<br><br>';
   echo '<a href="ch-Main.php">Go back to main page.</a>';
   exit();
  }
 }
 ?>
  <div align="center">
   <h2>修改錄音證道</h2><br>
   <h4>Editor: <?php echo $current_user->user_firstname.' '.$current_user->user_lastname.' (WordPress Site Login)' ; ?></h4><br/>
   <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="container">
     <div class="row justify-content-md-center">
      <table border=0 class="table table-striped">
       <thead>
        <tr>
         <th scope="col" class="text-right">Field</th>
         <th scope="col">Value</th>
        </tr>
       </thead>
       <tbody>
        <tr>
         <td align=right>日期 (yyyy-mm-dd): </td><td><input type="text" name="sermondate" value="<?php echo $sermondate;?>"><span class="fielderror">* <?php echo $sermondateErr;?></span></td>
        </tr>
        <tr>
         <td align=right>講員(Speaker):</td><td><input type="text" name="speaker" value="<?php echo $speaker;?>"><span class="fielderror">* <?php echo $speakerErr;?></span></td>
        </tr>
        <tr>
         <td align=right>主題(Topic):</td><td><input type="text" name="topic" size=40 value="<?php echo $topic;?>"><span class="fielderror">* <?php echo $topicErr;?></span></td>
        </tr>
        <tr>
         <td align=right>經節(Section): </td><td><input type="text" name="section" value="<?php echo $section;?>"></td>
        </tr>
        <tr>
         <td align=right>地點(Location): </td><td><input type="text" name="location" value="<?php echo $location;?>"><span class="fielderror">* <?php echo $locationErr;?></span></td>
        </tr>
        <tr>
         <td align=right>錄音檔名 (Audio File Name): </td><td><input type="text" name="audiofile" value="<?php echo $audiofile;?>"><span class="fielderror">* <?php echo $audiofileErr;?></span></td>
        </tr>
        <tr>
         <td align=right>聖經連結 (Bible Location ID):</td><td><input type="text" name="bibleID" value="<?php echo $bibleID;?>">&nbsp;&nbsp;&nbsp;
          <a href='http://bible.chineseforchristchurch.org/BibleMobile.php' target=_blank>查詢聖經location ID</a>
         </td>
        </tr>
        <tr>
         <td align=right>備註(Remark):</td><td><textarea name="remark" rows="5" cols="40"><?php echo $remark;?></textarea></td>
        </tr>
        <tr>
         <td colspan=2 align=center>
          <input type="submit" name="update" value="Update" class="btn btn-primary">
          <input type="hidden" name="sermonid" value="<?php echo $selectedId;?>">&nbsp;
          <input type="button" onclick="history.back()" value="Go Back" class="btn btn-warning"></input>&nbsp;
          <input type="submit" name="delete" value="delete" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">
         </td>
        </tr>
       </tbody>
      </table>
     </div>
    </div>
   </form>
  </div>
  </body>
</html>
