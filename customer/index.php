<?php
session_start();

if(empty($_SESSION['customer_logged_in']) || !$_SESSION['customer_logged_in']) {
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
  <div class="transaction-records">
    <h2>Transations</h2>
    <table border="1">
      <thead>
        <tr>
          <th>#</th>
          <th>Date Transacted</th>
          <th>Amount</th>
          <th>Transaction Type</th>
        </tr>
      </thead>
      <?php
      require_once "process/connection.php";
      $sql = "SELECT * FROM transaction_history WHERE bank_account_id=".$customer->id;
      ?>
      <tbody>
      <?php
      $result = $conn->query($sql);
      $i = 0;
      if ($result->num_rows > 0) { 
          while($row = $result->fetch_assoc()) { $i++; ?>
              <tr>
              <td style="padding: 0 10px;"><?php echo $i; ?>.</td>
              <td style="padding: 0 10px;"><?php echo $row['dt_transacted']; ?></td>
              <td style="padding: 0 10px; text-align: right;"><?php echo number_format($row['amount']); ?></td>
              <td style="padding: 0 10px;"><?php echo $row['transaction_type']; ?></td>
          <?php
          } // end of while..
      } else {
          echo "<tr><td colspan='4' style='text-align:center;'>No results found.</td></tr>";
      }
      $conn->close();
      ?>

      </tbody>
    </table>
  </div>
  <?php include_once "../footer.php"; ?>
</body>
</html>