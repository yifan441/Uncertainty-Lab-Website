#!/usr/local/bin/php
<?php
  
    session_start();

    function phpalert($string) {
        echo "<script type=\"text/javascript\">";
        echo "alert(\"$string\")";
        echo "</script>";
    }

   
    if($_SESSION["message"]) {
        phpalert($_SESSION["message"]);
        $_SESSION["message"] = "";
    }
?>
<!DOCTYPE html>

<html lang="en">

  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Sign Up (Version 2)</title> 
  </head>

  <body>

    <header id="header">
      <h1 id="signup" style="text-align:center">Sign Up</h1>
    </header>

    <main>
      <section id="section">
          <form method="POST" action="signupv2.php" style="text-align:center">
            <label for="firstname">First name:</label>
            <input value="" id="firstname" name="firstname">
            <br>
            <label for="lastname">Last name:</label>
            <input value="" id="lastname" name="lastname">
            <br>
            <label for="email" class="email">Email:</label>
            <input value="" id="email" name="email" class="email">
            <br>
            <label for="confirmemail" class="c">Confirm Email:</label>
            <input value="" class="c" id="confirm_email" name="confirm_email">
            <br>
            <input type="checkbox" id="tandc" name="tandc">
            <label for="tandc" id="terms">I accept the <a href="termsandconditions.html" target="_blank">Terms and Conditions</a>.</label>
            <br>
            <input type="submit" id="signupbutton" name="submit_signup" value="Sign Up!">
          </form>
      </section>
    </main>

  </body>
</html>