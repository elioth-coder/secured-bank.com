<div class="header">
    <?php $customer = json_decode($_SESSION['customer']); ?>
    <h1>
        <img src="<?php echo $customer->photo; ?>" 
            style="width: 50px; border-radius: 50%; margin-bottom: -10px;" 
        />
        <?php echo $customer->first_name; ?>
        <?php echo $customer->last_name; ?>
    </h1>
    <hr>
    <table border="1">
    <tr>
    <td>Account Number: </td>
    <td style="text-align:right;">
        <?php echo $customer->account_number; ?>
    </td>
    </tr>
    <tr>
    <td>Your Balance: </td>
    <td style="text-align:right;">
        <?php 
        require_once "./process/connection.php";

        $sql = "SELECT balance FROM bank_account WHERE id=" . $customer->id;
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $balance = $row['balance'];
        ?>
        <?php echo number_format($balance, 2); ?></td>
    </tr>
    </table>
</div>