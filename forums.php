<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secured Bank Website - Forums</title>
</head>
<body>
    <h1>Welcome to Secured Bank</h1>
    <h2>The #1 most secured bank in Asia.</h2>
    <ul>
        <li>
            <a href="/admin/">Go to Employee Login</a>
        </li>
        <li>
            <a href="/customer/">Go to Customer Login</a>
        </li>
        <li>
            <a href="/customer/sign_up.php">Go to Customer Sign Up</a>
        </li>
    </ul>
    <hr>
    <form action="./process/forum_topic.php" method="post" enctype="multipart/form-data">
        <h3>Post a topic in the forum</h3>
        <input type="file" name="file" id="file" /><br>
        <img src="" id="image" alt=""><br>
        <input type="text" name="title" placeholder="Enter title." /><br>
        <textarea name="description" placeholder="Enter description."></textarea><br>
        <br>
        <button type="submit">Submit</button>
    </form>

    <hr>
    <h2>Topics</h2>
    <style>
    table tr td {
        border-bottom: 1px solid #ddd;
    }
    </style>
    <table>
    <?php
    require_once "connection.php";
    $sql = "SELECT * FROM forum_topic ORDER BY dt_created DESC";
    $result = $conn->query($sql);
    $i = 0;
    if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) { $i++; ?>
            <tr>
            <td style="padding: 0 10px;">
                <img src="./images/<?php echo $row['image']; ?>" alt="" style="width: 100px">
            </td>
            <td style="padding: 0 10px; vertical-align: top;">
                <p style="margin: 0;"><?php echo $row['dt_created']; ?></p>
                <h4 style="margin: 0;"><a href="./forum_topic.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h4>
                <p style="margin: 0;"><?php echo $row['description']; ?></p><br>
                <a href="./forum_topic.php?id=<?php echo $row['id']; ?>#comment">
                    <button>Comment</button>
                </a>
            </td>
        <?php
        } // end of while..
    } else {
        echo "<tr><td colspan='2' style='text-align:center;'>No results found.</td></tr>";
    }
    $conn->close();      
    ?>
    </table>
    <?php include_once "footer.php"; ?>
    <script>
    file.onchange = (e) => {
        let file = e.target.files[0]; 
        image.src = URL.createObjectURL(file);
    }
    </script>
</body>
</html>