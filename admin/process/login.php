<?php
session_start();
require_once 'connection.php';

$sql = "SELECT * FROM user WHERE username='".$_POST['username']."' AND password='".$_POST['password']."'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();

  $_SESSION['user'] = json_encode($row);
  $_SESSION['logged_in'] = true;
	die(header("Location: ../"));
} else { ?>
  <p style='color:red;'>
    Invalid username or password. 
    <a href="../login.php"><button>Try again</button></a>
  </p>
<?php
} // end of else..
$conn->close();