<?php

  require "includes/Cloudinary.php";
  require "includes/Uploader.php";
  require "includes/Api.php";
  require "includes/Config.php";

  session_start();

  $correct_answer_image = FALSE;

    if(!isset($_POST["usernumber"])) {
      $message = "Can you guess my number?";
      $message .= "<p>" . cl_image_tag("businessman_gevhpt.png") . "</p>";
      $_SESSION["counter"] = 0;
    } elseif(empty($_POST["usernumber"])) {
      $message = "Missing Guess Parameter";
      $message .= "<p>" . cl_image_tag("delete-mark_ef5xjb.png") . "</p>";
      $_SESSION["counter"]++;
    } elseif(!is_numeric($_POST["usernumber"])) {
      $message = "Your guess is not a number";
      $message .= "<p>" . cl_image_tag("delete-mark_ef5xjb.png") . "</p>";
      $_SESSION["counter"]++;
    } elseif($_POST["usernumber"] < 42) {
      $message = "Your guess is too low";
      $message .= "<p>" . cl_image_tag("delete-mark_ef5xjb.png") . "</p>";
      $_SESSION["counter"]++;
    } elseif($_POST["usernumber"] > 42) {
      $message = "Your guess is too high";
      $message .= "<p>" . cl_image_tag("delete-mark_ef5xjb.png") . "</p>";
      $_SESSION["counter"]++;
    } else {
      $correct_answer_image = TRUE;
      $message ="Congratulations - You are right!";
      unset($_POST["usernumber"]);
      unset($_POST["submit"]);
      session_destroy();
      }

?>

<!DOCTYPE html>
<html>
  <head>
      <title>Gibe S. Tirol</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" / >
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="styles/custom.css"  type="text/css"/>
  </head>
  <body>
  <div class=" jumbotron container">
    <div class="row">
      <div class="col-md-12">
        <h1><?php print $message  ?></h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-offset-4 col-md-4 col-md-offset-4">
        <form action="" method="POST">
          <div class="form-group">
            <?php $style = "visibility:hidden;"; ?>
            <input type="text" style="<?php if ($correct_answer_image) print $style; ?>" class="form-control input-lg" name="usernumber" placeholder="Your guess number" />
          </div>
          <?php
             if ($correct_answer_image) {
                print "<center>" . cl_image_tag("thumbs-up_gpwpvz.png") . "</center>";
                print "<a class='btn btn-primary btn-lg center-block' style='margin-top:20px;'href='index.php'>Play Again</a><br />";
                print "<h3 class='text-center'>You had " . $_SESSION["counter"] . " attempt(s)</h3>";
              }
              else {
                print "<button type='submit' name='submit' class='btn btn-primary btn-lg center-block'>Guess The Number</button>";
              }
          ?>
        </form>
      <div>
    </div>
  </div>

  </body>
</html>
