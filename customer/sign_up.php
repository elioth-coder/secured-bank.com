<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secured Bank Website</title>
</head>
<body>
    <h2>Sign Up here</h2>
    <form action="/customer/process/sign_up.php" method="post" enctype="multipart/form-data">
        <p>Account Number: <br>
			<input placeholder="Enter account number."
				type="text" name="account_number" id="account_number"><br>
		</p>
        <p>Last Name: <br>
			<input placeholder="Enter last name."
				type="text" name="last_name" id="last_name"><br>
		</p>
        <p>First Name: <br>
			<input placeholder="Enter first name."
				type="text" name="first_name" id="first_name"><br>
		</p>
        <p>Birthday: <br>
			<input type="date" name="birthday" id="birthday"><br>
		</p>
        <p>Proof of Identity: <br>
			<input type="file" 
                name="proof_of_identity" 
                id="proof_of_identity"
            /><br>
            <img id="proof_preview" src="/customer/images/default.png" style="width:200px; height: 200px; display: block;"/>
		</p>
        <p>Username: <br>
			<input placeholder="Enter username."
				type="text" name="username" id="username"><br>
		</p>
        <p>Password: <br>
			<input placeholder="Enter password."
				type="text" name="password" id="password"><br>
		</p>
        <button type="submit">Sign Up</button>
		<a href="/"><button type="button">Cancel</button></a>
    </form>
    <?php include_once "../footer.php"; ?>
    <script>
        proof_of_identity.onchange = (e) => {
            let file = e.target.files[0];
            proof_preview.src = URL.createObjectURL(file);
        }
    </script>
</body>
</html>