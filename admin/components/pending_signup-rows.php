<?php
$result = $conn->query($sql);
$i = 0;
if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) { $i++; ?>
        <tr>
        <td style="padding: 0 10px;"><?php echo $i; ?>.</td>
        <td style="padding: 0 10px;">
            <img src="/customer/images/<?php echo $row['proof_of_identity']; ?>" alt="" style="width: 100px">
        </td>
        <td style="padding: 0 10px;"><?php echo $row['dt_registered']; ?></td>
        <td style="padding: 0 10px;"><?php echo $row['account_number']; ?></td>
        <td style="padding: 0 10px;"><?php echo $row['first_name']." ".$row['last_name']; ?></td>
        <td style="padding: 0 10px;"><?php echo $row['birthday']; ?></td>
        <td style="padding: 0 10px;"><?php echo $row['username']; ?></td>
        <td style="padding: 0 10px;">********</td>
        <td style="padding: 0 10px;"><?php echo $row['status']; ?></td>
        <td style="padding: 0 10px;">
            <?php if($row['status'] == 'PENDING') { ?>
            <a href="/admin/process/approve_signup.php?ok=1&account_number=<?php echo $row['account_number']; ?>">
                <button>Approved</button>
            </a>
            <a href="/admin/process/approve_signup.php?ok=0&account_number=<?php echo $row['account_number']; ?>">
                <button>Disapproved</button>
            </a>
            <?php } // end of if.. ?>
        </tr>
    <?php
    } // end of while..
} else {
    echo "<tr><td colspan='10' style='text-align:center;'>No results found.</td></tr>";
}
$conn->close();
?>
