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
  <h3>
      Search account: 
      <input id="search"
        style="width: 300px;" type="search" 
        placeholder="Enter account number" 
      />
    </h3>
  <h2>Approved pending Sign ups.</h2>
  <div class="pending-list">
    <table border="1" id="pendings-table">
      <thead>
      <tr>
        <th>#</th>
        <th>Proof of Identity</th>
				<th>Date Registered</th>
        <th>Account Number</th>
        <th>Full name</th>
        <th>Birthday</th>
        <th>Username</th>
        <th>Password</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      <?php
        require_once "process/connection.php";
        $sql = "SELECT * FROM registration_que ORDER BY dt_registered ASC";
        include_once "components/pending_signup-rows.php";
      ?>
      </tbody>
    </table>
  </div>
  <?php include_once "../footer.php"; ?>
  <script>
  search.onkeyup = (e) => {
    let search = e.target.value;

    fetch('/admin/process/search-pending_signups.php?search=' + search)
      .then((response) => response.text())
      .then((data) => {
        let tbody = document.querySelector('#pendings-table tbody');

        tbody.innerHTML = data;
      });
  }
  </script>
</body>
</html>