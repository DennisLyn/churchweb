<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Use bootstrap style for UI layout -->
    <script src="./js/bootstrap.min.js"></script>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <title>Sermon Management</title>
  </head>
  <body>
  <?php
  /**
   * Integrated WordPress functions for user authentication and plugging PHP page into WordPress site
   * Sermon code folder should be added at the same root of the WordPress site
   */
  require_once('../wp-load.php');
  require_once('../wp-includes/pluggable.php');

  /**
   * Page can be logged out by query param
   * For example: /ch-sermon/ch-Main.php?Action=logout
   */
  if ($_GET['Action'] == 'logout')
  {
    wp_destroy_current_session();
    wp_clear_auth_cookie();
    echo '<div align="center"><br/><br/>';
    echo '<h4>You have logged out. Thank you!</h4><br/><br/>';
    echo '<a href="/" class="btn btn-success btn-lg" role="button">Go back to main site.</a><br/><br/>';
    echo '<a href="../wp-login.php" class="btn btn-primary btn-lg" role="button">Go back to login page.</a><br/><br/>';
    echo '</div>';
    echo '</body>';
    exit();
  }

  // Check if login or not
  if (is_user_logged_in())
  {
    $current_user = wp_get_current_user();
  } else {
    echo 'Welcome, visitor! Please login website for admin function: <br/><br/>';
    echo '<a href="../wp-login.php">Go back to login page.</a>';
    echo '</body>';
    exit();
  }
  ?>
    <div align=center>
      <h2>中華歸主海沃教會</h2>
      <h4>Hello! <?php echo $current_user->user_firstname.' '.$current_user->user_lastname.' (WordPress Site Login)'; ?></h4><br/><br/>
      <form>
        <button type="submit" class="btn btn-primary" formaction="ch-SermonCreate.php">1.新增證道錄音資料 (Create sermon record)</button><br/><br/>
        <button type="submit" class="btn btn-primary" formaction="ch-SermonUpdateList.php">2.修改證道錄音資料 (Update sermon record)</button><br/><br/>
        <a class="btn btn-warning" href="./ch-Main.php?Action=logout" role="button">登出系統 Log Out</a>
      </form>
    </div>
  </body>
</html>
