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
  <div class="account-list">
    <h3>
      Search account: 
      <input id="search"
        style="width: 300px;" type="search" 
        placeholder="Enter account number" 
      />
    </h3>
    <table border="1" id="accounts-table">
      <thead>
      <tr>
        <th>#</th>
        <th>Photo</th>
        <th>Date created</th>
        <th>Account no.</th>
        <th>Full name</th>
        <th>Gender</th>
        <th>Birthday</th>
        <th>Balance</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      <?php
        require_once "process/connection.php";
        $sql = "SELECT * FROM bank_account";
        include_once "components/bank_account-rows.php";
      ?>
      </tbody>
    </table>
  </div>
  <?php include_once "../footer.php"; ?>
  <script>
  search.onkeyup = (e) => {
    let search = e.target.value;

    fetch('/admin/process/search-account.php?search=' + search)
      .then((response) => response.text())
      .then((data) => {
        let tbody = document.querySelector('#accounts-table tbody');

        tbody.innerHTML = data;
      });
  }
  </script>
</body>
</html>