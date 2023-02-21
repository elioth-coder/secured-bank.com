<?php
require_once 'connection.php';

$sql = "INSERT INTO registration_que 
    (
        account_number, 
        proof_of_identity, 
        last_name, 
        first_name, 
        birthday, 
        username,
        password
    ) 
    VALUES 
    (
        '". $_POST['account_number'] ."', ".
        "'". $_FILES["proof_of_identity"]["name"] ."', ".
        "'". $_POST['last_name'] . "', ".
        "'". $_POST['first_name'] . "', ".
        "'". $_POST['birthday'] . "', ".
        "'". $_POST['username'] . "', ".
        "'". $_POST['password'] . "'" .
    ")";

if ($conn->query($sql) === TRUE) {
  echo "<p>Signed up successfully waiting for approval.</p><a href='/'><button>Back to Home</button></a>";
} else {
  echo "<p style='color:red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
}

$target_file = "../images/" . $_FILES["proof_of_identity"]["name"];
if (move_uploaded_file($_FILES["proof_of_identity"]["tmp_name"], $target_file)) {
    echo "<p>The file ". htmlspecialchars( basename( $_FILES["proof_of_identity"]["name"])). " has been uploaded.</p>";
} else {
    echo "<p style='color:red;'>Sorry, there was an error uploading your file.</p>";
}
?>