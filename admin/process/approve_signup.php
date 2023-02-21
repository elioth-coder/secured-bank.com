<?php
session_start();
require_once 'connection.php';

if(!$_GET['ok']) {
	$sql = "UPDATE registration_que SET status='DISAPPROVED'
		WHERE account_number='". $_GET['account_number'] ."'";

	if ($conn->query($sql) === TRUE) {
		echo "<p>Successfully disapproved sign up of customer!</p><a href='../'><button>Back to Home</button></a>";
	} else {
		echo "<p style='color:red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
	}

	$conn->close();
	die();
}

$conn->begin_transaction();
try {
	$sql = "UPDATE registration_que SET status='APPROVED'
		WHERE account_number='". $_GET['account_number'] ."'";

	$conn->query($sql);

	$sql = "INSERT INTO customer (bank_account_id, username, password) 
		VALUES (
			(SELECT id FROM bank_account WHERE account_number='" . $_GET['account_number'] . "'),
			(SELECT username FROM registration_que WHERE account_number='" . $_GET['account_number'] . "'),
			(SELECT password FROM registration_que WHERE account_number='" . $_GET['account_number'] . "')
		)";

	$conn->query($sql);
	$conn->commit();
	
	echo "<p>Successfully approved sign up of customer!</p><a href='../'><button>Back to Home</button></a>";
} catch (mysqli_sql_exception $exception) {
	$conn->rollback();

	echo "<p style='color:red;'>Error: " . $sql . "<br>" . $exception->getMessage() . "</p>";
}

$conn->close();