<?php
session_start();

if(empty($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
  header('Location: ./login.php');
  die();  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Secured Bank Website</title>
</head>
<body>
  <?php include_once "components/header.php"; ?>
  <?php include_once "components/menu.php"; ?>
	<?php
	require_once "process/connection.php";
	$sql = "SELECT * FROM bank_account WHERE account_number='" . $_GET['account_number'] . "'";
	$result = $conn->query($sql);
	$i = 0;
	if ($result->num_rows > 0) { 
		$account = $result->fetch_assoc();
	}
	?>
  <h2>Transfer money of customer.</h2>
  <img id="photo" src="<?php echo $account['photo']; ?>" style="border: 1px solid #000; width: 240px; height: 240px; display:block" />
  <h3>Account name: <?php echo $account['first_name']. " " . $account['last_name']; ?></h3>
  <h3>Account number: <?php echo $account['account_number']; ?></h3>
	<form action="/admin/process/transfer_money.php" method="post">
	<input type="hidden" name="sender_id" value="<?php echo $account['id']; ?>">
	<input type="hidden" name="transacted_by" value="<?php echo $user->id; ?>">
		<p>Amount to transfer: <br>
			<input placeholder="Enter amount to transfer."
				type="text" name="amount" id="amount"><br>
		</p>
		<p>Transfer to: <br>
			<select name="receiver_id">
				<option value="">Select account number.</option>
				<?php
				$sql = "SELECT * FROM bank_account";
				$result = $conn->query($sql);
				$i = 0;
				if ($result->num_rows > 0) { 
						while($row = $result->fetch_assoc()) { 
							$i++; 
							if($account['id'] == $row['id']) continue;
							?>
							<option value="<?php echo $row['id']; ?>">
									<?php echo "Account # " . $row['account_number'] . " - "; ?>
									<?php echo $row['first_name'] . " " . $row['last_name']; ?>
							</option>
						<?php
						} // end of while..
				}
				$conn->close();
				?>
      </select><br>
		</p>
		<button type="submit">Transfer Amount</button>
		<a href="./"><button type="button">Cancel</button></a>
	</form>
	<?php include_once "../footer.php"; ?>
</body>
</html>