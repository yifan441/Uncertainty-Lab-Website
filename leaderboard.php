#!/usr/local/bin/php
<?php 
   
    session_start();

    $db = new SQLite3('participants.db');


    $statement = 'SELECT firstname FROM participants WHERE lastname=\''.$_SESSION["UserData"]["username"].'\'';
    $results = $db->query($statement);
    $row = $results->fetchArray();
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $date = $row['cdate'];
    $followupversion = $row['followupversion'];
    $followup=$row['followup'];
    $affiliation = $row['affiliation']; 
    $statement = 'SELECT DISTINCT affiliation FROM participants';
    $list_results = $db->query($statement);

    $rows = $db->query("SELECT COUNT(*) as count FROM participants");
    $row = $rows->fetchArray();
    $numrows = $row['count'];
    $arrayforwinner = array();


    while($dorm_list = $list_results->fetchArray())
        {

            $rows = $db -> query('SELECT COUNT(*) as count FROM participants WHERE affiliation="'.$dorm_list['affiliation'].'"');
            $row = $rows->fetchArray();
            $arrayforwinner[] = $row['count'];

        }
    $statement = 'SELECT affiliation FROM participants GROUP BY affiliation HAVING COUNT(*)='.max($arrayforwinner);
    $results = $db->query($statement);
    $row = $results->fetchArray();
    $i = 1;
    while ($i<2){
    $winner = $row['affiliation'];
    $i+=1;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Precommitment LeaderBoard</title>
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
        <h1>LeaderBoard</h1>
      </header>

      <main>
        <p><span id="winner-span"><?php echo $winner; ?></span> is winning!!</p>
        <div id="table-div">
        <?php
            echo "<table style=\"border:1px solid black\">
            <tr>
            <th>Dorm</th>
            <th>Number Committed</th>
            </tr>";

            while($dorm_list = $list_results->fetchArray())
            {

            echo "<tr>";
            $rows = $db -> query('SELECT COUNT(*) as count FROM participants WHERE affiliation="'.$dorm_list['affiliation'].'"');
            $row = $rows->fetchArray();
            echo "<td>".$dorm_list['affiliation']."</td>";
            echo "<td>".$row['count']."</td></tr>";
        }
            echo "</table>";
            $db->close();
            ?>
        </div>
      </main>
    </div>
  </body>
</html>
