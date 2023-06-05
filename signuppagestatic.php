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
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="signuppagestatic.css" />
    <title>Sign Up</title>
  </head>

  <body>
    <main>
      <div id="main-div">

        <div id="secondary-div">
          <h1 id="signup-text">Welcome!</h1>
          <p id="subtext">Make a precommitment today</p>
          <form method="POST" action="signup.php">
            <label for="firstname">First name:</label>
            <input value="" id="firstname" name="firstname" placeholder="Joe"/>
            <label for="lastname">Last name:</label>
            <input value="" id="lastname" name="lastname" placeholder="Bruin"/>
            <label for="email" class="email">Email:</label>
            <input value="" id="email" name="email" class="email" placeholder="example@gmail.com"/>
            <label for="confirmemail" class="c">Confirm Email:</label>
            <input value="" class="c" id="confirm_email" name="confirm_email" placeholder="example@gmail.com"/>
        </div>
        <input type="checkbox" id="tandc" name="tandc" />
        <label for="tandc" id="terms">
          I have read and accept the
          <a href="termsandconditions.html" target="_blank">
            Terms and Conditions</a>
        </label>
          <input
            type="submit"
            id="signupbutton"
            name="submit_signup"
            value="Commit!"
          />
        </form>
      </div>
    </main>
  </body>
</html>
