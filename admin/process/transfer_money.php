<?php
session_start();
require_once 'connection.php';

$conn->begin_transaction();

try{
    $sql = "INSERT INTO transaction_history (bank_account_id, amount, transaction_type) VALUES 
    (
        '". $_POST['receiver_id'] ."', ".
        "'". $_POST['amount'] . "', ".
        "'RECEIVE MONEY'".
    ")";
    $conn->query($sql);
    $sql = "INSERT INTO transaction_history (bank_account_id, amount, transaction_type) VALUES 
    (
        '". $_POST['sender_id'] ."', ".
        "'-". $_POST['amount'] . "', ".
        "'SEND MONEY'".
    ")";
    $conn->query($sql);
    $conn->query($sql);
    $insert_id = $conn->insert_id;

    $sql = "INSERT INTO money_transfer (account_id_sender, account_id_receiver, amount, transacted_by, transaction_history_id) VALUES 
    (
        '". $_POST['sender_id'] ."', ".
        "'". $_POST['receiver_id'] . "', ".
        "'". $_POST['amount'] . "', ".
        "'". $_POST['transacted_by'] . "', ".
        "'". $insert_id . "'".
    ")";
    $conn->query($sql);

    $sql = "UPDATE bank_account SET balance=balance-".$_POST['amount']." WHERE id=". $_POST['sender_id'];
    $conn->query($sql);
    $sql = "UPDATE bank_account SET balance=balance+".$_POST['amount']." WHERE id=". $_POST['receiver_id'];
    $conn->query($sql);
    $conn->commit();
		
    echo "<p style='color:green;'>Successfully transferred money!</p>";
    echo "<a href='../'><button>Back to home</button></a>";
} catch (mysqli_sql_exception $exception) {
    $conn->rollback();

    echo "<p style='color:red;'>Error: " . $sql . "<br>" . $exception->getMessage() . "</p>";
}

$conn->close();