<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Use bootstrap style for UI layout -->
    <script src="./js/bootstrap.min.js"></script>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <title>Create Sermon - Edit audio</title>
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

  if (is_user_logged_in())
  {
    $current_user = wp_get_current_user();
  } else {
    echo 'Welcome, visitor! Please login website for admin function.<br/><br/>';
    echo '<a href="../wp-login.php">Go back to login page.</a>';
    echo '</body>';
    exit();
  }

  $TheSermonApp= new SermonApp;
  $TheSermonInfo= new SermonInfo;
  $TheSermonList=$TheSermonApp->listSermon();
  ?>
  <div align="center">
    <h2>修改錄音證道-選取證道錄音</h2><br/>
    <form method="post" action="ch-SermonUpdate.php" class="form-inline">
      <select name="sermonid" class="form-control input-lg">
      <?php
        $icounter = 0;
        $sermondate_01 = '1900'; // initial year
        $row_cnt = $TheSermonList->num_rows;

        // Generate select dropdown
        while($icounter < $row_cnt) {
          $TheSermon = mysqli_fetch_assoc($TheSermonList);
          $sermondate_00 = substr($TheSermon["sermondate"],0,4);

          if ($sermondate_00 != $sermondate_01) {
            // First option
            if ($icounter == 0) {
              echo '<optgroup label=""'.htmlspecialchars($sermondate_00).' Year';
              echo ' ------------------------------------->';
            } else {
              echo '</optgroup><optgroup label=""'.htmlspecialchars($sermondate_00).' Year';
              echo ' ------------------------------------->';
            }
          } echo '<option value=""'.htmlspecialchars($TheSermon['id'])
            .'>'.htmlspecialchars($TheSermon["sermondate"])
            .']'.htmlspecialchars($TheSermon["topic"])
            .'</option>';
          $sermondate_01=substr($TheSermon["sermondate"],0,4);
          $icounter = $icounter+1;
        }
        echo '</optgroup>';
      ?>
      </select>
      <input type="submit" name="submit" value="Select" class="btn btn-info"><br/><br/>
      <input type="button" onclick="history.back()" value="Go Back" class="btn btn-warning"></input>
    </form>
  </div>
  </body>
</html>
