
<?php
require_once dirname(__FILE__)."/ch-SermonDAO.php";

$TheSermonApp = new SermonApp;

if (!empty($_GET)) {
  $TheSermonYear = $_GET['SermonYear'];
  if (isset($TheSermonYear)) {
    $TheSermonList = $TheSermonApp->listSermonByYear($TheSermonYear);
  }
} else {
  $TheSermonYear="2011"; // initial year
  $TheSermonList = $TheSermonApp->listSermonByYear($TheSermonYear);
}

?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Use bootstrap style for UI layout -->
    <script src="./js/bootstrap.min.js"></script>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <title>Sermon List</title>
  </head>
  <body>
    <h2>Sermon List for
    <?php
    echo htmlspecialchars($TheSermonYear);
    ?>
    </h2>
    <table class="table table-striped table-hover borderless">
      <tbody>
      <?php
        $listCounter = 0;
        while($TheSermon = mysqli_fetch_assoc($TheSermonList)) {
          echo '<tr><td class="vn">'.htmlspecialchars($TheSermon['sermondate']).':'.htmlspecialchars($TheSermon['speaker']).'</td> <td class="v b5">'.htmlspecialchars($TheSermon['topic']).'</td></tr>';
          $listCounter = $listCounter+1;
        }
      ?>
      </tbody>
    </table>
  </body>
</html>
