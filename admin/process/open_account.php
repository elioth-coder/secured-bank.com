<?php
session_start();
require_once 'connection.php';

$sql = "INSERT INTO bank_account (photo, account_number, balance, last_name, first_name, gender, birthday) VALUES 
(
    '". $_POST['photo'] ."', ".
    "'". $_POST['account_number'] ."', ".
    "'". $_POST['balance'] . "', ".
    "'". $_POST['last_name'] . "', ".
    "'". $_POST['first_name'] . "', ".
    "'". $_POST['gender'] . "', ".
    "'". $_POST['birthday'] . "'" .
")";

if ($conn->query($sql) === TRUE) {
  echo "<p>New account created successfully</p><a href='../'><button>Back to Home</button></a>";
} else {
  echo "<p style='color:red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
}

$conn->close();