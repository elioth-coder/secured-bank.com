<?php
require_once "connection.php";

$sql = "SELECT * FROM bank_account WHERE account_number LIKE '%". $_GET['search']."%'";
include_once "../components/bank_account-rows.php";