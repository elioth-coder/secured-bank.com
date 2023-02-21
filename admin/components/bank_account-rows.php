<?php
$result = $conn->query($sql);
$i = 0;
if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) { $i++; ?>
        <tr>
        <td style="padding: 0 10px;"><?php echo $i; ?>.</td>
        <td style="padding: 0 10px;">
            <img src="<?php echo $row['photo']; ?>" alt="" style="width: 100px">
        </td>
        <td style="padding: 0 10px;"><?php echo $row['dt_created']; ?></td>
        <td style="padding: 0 10px;"><?php echo $row['account_number']; ?></td>
        <td style="padding: 0 10px;"><?php echo $row['first_name']." ".$row['last_name']; ?></td>
        <td style="padding: 0 10px;"><?php echo $row['gender']; ?></td>
        <td style="padding: 0 10px;"><?php echo $row['birthday']; ?></td>
        <td style="padding: 0 10px; text-align: right;"><?php echo number_format($row['balance']); ?></td>
        <td style="padding: 0 10px;">
            <a href="/admin/transfer_money.php?account_number=<?php echo $row['account_number']; ?>">
            Transfer Money
            </a>
        </tr>
    <?php
    } // end of while..
} else {
    echo "<tr><td colspan='7' style='text-align:center;'>No results found.</td></tr>";
}
$conn->close();
?>
