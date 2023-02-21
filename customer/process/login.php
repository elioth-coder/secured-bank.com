<?php
session_start();
require_once 'connection.php';
$sql = "SELECT C.id AS customer_id, C.username, B.* FROM `customer` C 
        INNER JOIN bank_account B ON C.bank_account_id=B.id 
        WHERE C.username='".$_POST['username']."' AND C.password='".$_POST['password']."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();

  $_SESSION['customer'] = json_encode($row);
  $_SESSION['customer_logged_in'] = true;
	die(header("Location: ../"));
} else { ?>
  <p style='color:red;'>
    Invalid username or password. 
    <a href="../login.php"><button>Try again</button></a>
  </p>
<?php
} // end of else..
$conn->close();

