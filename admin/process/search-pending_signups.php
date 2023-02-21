<?php
require_once "connection.php";

$sql = "SELECT * FROM registration_que WHERE account_number LIKE '%". $_GET['search']."%'";
include_once "../components/pending_signup-rows.php";