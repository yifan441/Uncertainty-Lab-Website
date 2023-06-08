#!/usr/local/bin/php
<?php 
   
    session_start();

    $db = new SQLite3('participants.db');

    $statement = 'CREATE TABLE IF NOT EXISTS participants(firstname TEXT, lastname TEXT, email TEXT, cdate TEXT, version INTEGER)';
    $db->exec($statement);

    $statement = 'SELECT firstname FROM participants WHERE lastname=\''.$_SESSION["UserData"]["username"].'\'';
    $results = $db->query($statement);
    $row = $results->fetchArray();
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $date = $row['cdate'];
    $version = $row['version'];
    $followup=$row['followup'];
    $statement = 'SELECT * FROM participants';
    $list_results = $db->query($statement);

    $rows = $db->query("SELECT COUNT(*) as count FROM participants");
    $row = $rows->fetchArray();
    $numrows = $row['count'];

    $lastinitial = mb_substr($lastname, 0, 1)."."; // first character of lastname


    $statement = "SELECT DATE('now','localtime') FROM "; 
    $time = "";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Precommitment Dashboard</title>
    <script src="homebutton.js" defer></script>
    <link rel="stylesheet" href="dashboard.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
  </head>

  <body>
    <input type="button" value="Home" id="home-btn" />
    <div id="main-div">
      <header>
        <h1>Dashboard</h1>
      </header>

      <main>
        <p>Thank you for committing!</p>
        <h3>
          <span id="number-committed">
            <?php echo $numrows; ?>
          </span> 
          people have committed! Click <a href="leaderboard.php">here</a> to check out the Leaderboard.
        </h3>
        <div id="table-div">
          <?php
              echo "<table style=\"border:1px solid black\">
              <tr>
              <th>Name</th>
              <th>Dorm</th>
              <th>Date of Commitment</th>
              <th>Followed Through?</th>
              </tr>";
              while($name_list = $list_results->fetchArray())
              {
                  echo "<tr>";
                  echo "<td>".$name_list['firstname']." ".mb_substr($name_list['lastname'], 0, 1)."."."</td>";
                  echo "<td>".$name_list['affiliation']."</td>";
                  echo "<td>".$name_list['cdate']."</td>"; 
                  if ($name_list['followup']==0){
                      echo "<td> <input type=\"checkbox\" disabled=\"disabled\"> </td>"; 
                  }
                  else {
                      echo "<td> <input type=\"checkbox\" disabled=\"disabled\" checked=\"checked\"> </td>";
                  } 
                  echo "</tr>";
              }
              echo "</table>";
              $db->close();
          ?>
        </div>
      </main>
    </div>
  </body>
</html>


<!--

Code I used to test css w/o php insert

            <p>
          <span id="number-committed">10</span> people have committed! Click
          <a href="leaderboard.php">here</a> to check out the Leaderboard.
        </p>
        <div id="table-div">
          <table style="border: 1px solid black" id="dashtb">
            <tr>
              <th>Name</th>
              <th>Dorm</th>
              <th>Date of Committement</th>
              <th>Followed Through?</th>
            </tr>

            <tr>
              <td>Yifan T.</td>
              <td>Rose Ave/Clarington</td>
              <td>06/17/2023</td>
              <td>
                <label class="container">
                  <input
                    type="checkbox"
                    disabled="disabled"
                    checked="checked"
                  />
                  <span class="checkmark"></span>
                </label>
              </td>
            </tr>
            <tr>
              <td>Roshenthal T.</td>
              <td>Rose Ave/Clarington</td>
              <td>06/17/2023</td>
              <td>
                <label class="container">
                  <input type="checkbox" disabled="disabled" />
                  <span class="checkmark"></span>
                </label>
              </td>
            </tr>
          </table>

-->
