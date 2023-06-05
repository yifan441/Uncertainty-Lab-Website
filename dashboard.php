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
        <meta charset="UTF-8">
        <title>Precommitment Dashboard</title>
    </head>

    <body>
        <header>
            <h1>Thank you for committing!</h1>
        </header>

        <main>
            <h3><?php echo $numrows; ?> people have committed!</h3>
            <?php
            echo "<table style=\"border:1px solid black\">
            <tr>
            <th>Name</th>
            <th>Date of Committement</th>
            <th>Version</th>
            <th>Committed?</th>
            </tr>";
            while($name_list = $list_results->fetchArray())
            {
                echo "<tr>";
                echo "<td>".$name_list['firstname']." ".mb_substr($name_list['lastname'], 0, 1)."."."</td>";
                echo "<td>".$name_list['cdate']."</td>";
                echo "<td>".$name_list['version']."</td>"; 
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
        </main>
    </body>
</html>