<?php
session_start();

if(empty($_SESSION['customer_logged_in']) || !$_SESSION['customer_logged_in']) {
    header('Location: ../customer/login.php');
    die();  
}
  
require_once "../connection.php";

$customer = json_decode($_SESSION['customer']);

$sql = "INSERT INTO forum_topic (title, image, description, customer_id)
    VALUES ('". $_POST['title'] ."', '" . $_FILES["file"]["name"] . "', '". $_POST['description'] ."', " . $customer->customer_id . ")";

if ($conn->query($sql) === TRUE) {
    echo "<p>Submitted topic successfully.</p><a href='../forums.php'><button>Back to Forums</button></a>";
} else {
    echo "<p style='color:red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
}
  
  $target_file = "../images/" . $_FILES["file"]["name"];
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    echo "<p>The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.</p>";
  } else {
    echo "<p style='color:red;'>Sorry, there was an error uploading your file.</p>";
  }
  ?>