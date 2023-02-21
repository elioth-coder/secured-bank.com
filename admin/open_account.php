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
  <h2>Open an account for customer.</h2>
  <h3>Enter customer details</h3>
  	<p>Photo:</p>
	<div id="camera" style="background-color: #000; width: 240px; height: 240px; display:none;"></div>
	<img id="photo" src="images/profile.png" style="border: 1px solid #000; width: 240px; height: 240px; display:block" />
	<button id="open-camera" onclick="openCamera();">Open Camera</button>
	<button style="display: none;" id="clear-photo" onclick="clearPhoto();">Clear Photo</button>
	<button style="display: none;" id="take-photo" onclick="takeSnapshot();">Take Snapshot</button>
	<form action="/admin/process/open_account.php" method="post">
		<input type="hidden" name="photo" id="photo-data" value="/admin/images/profile.png">
		<p>Account Number: <br>
			<input placeholder="Enter account number."
				type="text" name="account_number" id="account_number"><br>
		</p>
		<p>Inital Balance: <br>
			<input placeholder="Enter initial balance."
				type="text" name="balance" id="balance"><br>
		</p>
		<p>Last name: <br>
			<input placeholder="Enter customer's last name."
				type="text" name="last_name" id="last_name"><br>
		</p>
		<p>First name: <br>
			<input placeholder="Enter customer's first name."
				type="text" name="first_name" id="first_name"><br>
		</p>
		<p>Gender: <br>
			<select name="gender">
				<option value="">Select gender.</option>
				<option value="MALE">Male</option>
				<option value="FEMALE">Female</option>
			</select><br>
		</p>
		<p>Birthday: <br>
			<input placeholder="Enter customer's birthday."
				type="date" name="birthday" id="birthday"><br>
		</p>
		<button type="submit">Create Account</button>
		<a href="./"><button type="button">Cancel</button></a>
	</form>
	<?php include_once "../footer.php"; ?>
	<script src="assets/js/webcam.min.js"></script>
	<script>
		function openCamera() {
			document.querySelector('#clear-photo').style.display = 'none';
			document.querySelector('#camera').style.display = 'block';
			document.querySelector('#photo').style.display = 'none';
			document.querySelector('#open-camera').style.display = 'none';
			document.querySelector('#take-photo').style.display = 'block';
			
			Webcam.attach('#camera');
			Webcam.set({
				width: 240,
				height: 240,
				flip_horiz: true
			});
		}

		function closeCamera() {
			document.querySelector('#camera').style.display = 'none';
			document.querySelector('#photo').style.display = 'block';
			document.querySelector('#open-camera').style.display = 'block';
			document.querySelector('#take-photo').style.display = 'none';
			Webcam.reset();			
		}

		function takeSnapshot() {
			Webcam.snap( function(data_uri) {
				document.querySelector('#photo').src = data_uri;
				document.querySelector('#photo-data').value = data_uri;
				document.querySelector('#clear-photo').style.display = 'block';
			});

			closeCamera();
		}

		function clearPhoto() {
			document.querySelector('#clear-photo').style.display = 'none';
			document.querySelector('#camera').style.display = 'none';
			document.querySelector('#photo').style.display = 'block';
			document.querySelector('#open-camera').style.display = 'block';
			document.querySelector('#take-photo').style.display = 'none';

			document.querySelector('#photo').src='images/profile.png';
			document.querySelector('#photo-data').value='images/profile.png';
		}
	</script>
</body>
</html>