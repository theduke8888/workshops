<?php

  require "includes/Cloudinary.php";
  require "includes/Uploader.php";
  require "includes/Api.php";
  require "includes/Config.php";

  session_start();

  $correct_answer_image = FALSE;
  if(!isset($_POST["usernumber"])) {
    $message = "I have a number between 1 and 20.<br>Can you guess my number?";
    $message .= "<p>" . cl_image_tag("businessman_gevhpt.png") . "</p>";
    $_SESSION["randomnumber"] = rand(1,20);
    $_SESSION["counter"] = 0;

} elseif ($_POST["usernumber"] != $_SESSION["randomnumber"] ) {
    $wrong_answer = rand(1,4);
    if ($_POST["usernumber"] > $_SESSION["randomnumber"]) $message = "Too High<br />";
    else $message = "Too Low<br />";
    switch ($wrong_answer) {
        case 1:
          $message .= "No. Please Try Again."; break;
        case 2:
          $message .= "Wrong. Try Once More."; break;
        case 3:
          $message .= "Don't Give Up!"; break;
        default:
          $message .= "No. Keep Trying"; break;
        }
        $message .= "<p>" . cl_image_tag("delete-mark_ef5xjb.png") . "</p>";
        $_SESSION["counter"]++;
  } else {
      $correct_answer_image = TRUE;
      $correct_answer = rand(1,4);
      switch ($correct_answer) {
        case 1:
          $message = "Very Good!"; break;
        case 2:
          $message = "Excellent"; break;
        case 3:
          $message = "Nice Work!"; break;
        default:
          $message = "Keep Up The Good Work";
        unset($_SESSION["counter"]);
        unset($_SESSION["randomnumber"]);
        unset($_POST["usernumber"]);
        session_destroy();
      }
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
