<?php
session_start();

if(!empty($_SESSION['logged_in']) && $_SESSION['logged_in']) {
  header('Location: ./');
  die();  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login</title>
</head>
<body>
    <h1>Employee Login Here</h1>
    <hr>
    <form method="post" action="/admin/process/login.php">
        <input type="text" name="username" 
            placeholder="Enter username."
            id="username"
        /><br>
        <input type="password" name="password" 
            placeholder="Enter password."
            id="password"
        /><br>
        <button type="submit">Log in</button>
    </form>
    <?php include_once "../footer.php"; ?>
</body>
</html>