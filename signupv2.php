#!/usr/local/bin/php
<?php

    session_start();

    if($_POST["submit_signup"]) {
       
        $submitted_firstname = isset($_POST["firstname"]) ? $_POST["firstname"]: "";
        $submitted_lastname = isset($_POST["lastname"]) ? $_POST["lastname"]: "";
        $submitted_email = isset($_POST["email"]) ? $_POST["email"]: "";
        $submitted_confirm_email = isset($_POST["confirm_email"]) ? $_POST["confirm_email"]: "";
        $checked = isset($_POST["tandc"]);
        date_default_timezone_set('America/Los_Angeles');
        $date = date('m/d/Y');

        $version = 2; 
        $followup=1;



        if(!$submitted_firstname) {
            $_SESSION["message"] = "Please enter your first name.";
        }
 
        else if(!$submitted_lastname) {
            $_SESSION["message"] = "Please enter your last name.";
        }

        else if(!$submitted_email) {
            $_SESSION["message"] = "Please enter your email.";
        }
       
        else if($submitted_email != $submitted_confirm_email) {
            $_SESSION["message"] = "Emails do not match, please reenter.";
        }
        else if(!filter_var($submitted_email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["message"] = "Email is invalid, please reenter.";
        }

        else if(!$checked){
            $_SESSION["message"] = "Please confirm that you have read the Terms and Conditions.";
        }
     
        else {
            $db = new SQLite3('participants.db');

            $statement = 'CREATE TABLE IF NOT EXISTS participants(firstname TEXT, lastname TEXT, email TEXT, cdate TEXT, version INTEGER, followup INTEGER)';
            $db->exec($statement); 
            $statement = 'SELECT lastname FROM participants WHERE email=\''.$submitted_email.'\'';
            $results = $db->query($statement);
            $row = $results->fetchArray();
            if($row['lastname']) {
                $_SESSION["message"] = "You have already committed!";
            } else {
                $statement = 'INSERT INTO participants (firstname, lastname, email, cdate, version, followup) VALUES (\''.ucwords(strtolower($submitted_firstname)).'\', \''.ucwords(strtolower($submitted_lastname)).'\', \''.$submitted_email.'\', \''.$date.'\', '.$version.', '.$followup.')';
                $db->exec($statement);
                $db->close();
                //$_SESSION["message"] = "Registration successful! Thank you for committing!";
                header("Location: dashboard.php");
                exit;

            }
            $db->exec($statement);
            $db->close();
        }
           
    }

    header("Location: signuppagev2.php");
    exit;

?>