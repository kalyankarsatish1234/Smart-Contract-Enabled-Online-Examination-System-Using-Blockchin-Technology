<!DOCTYPE html>
<html>
	<head>
		<title>Exam-Portal</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link type="text/css" rel="stylesheet" href="login.css">
		<!-- <link type="text/css" rel="stylesheet" href="security.css"> -->
		<script src="functions.js"></script>
	</head>
	<body>
		<?php
			$id = $_POST["ide"];
		?>
		<div class="login-box">
			<h2>Verification</h2>
			<form action="login.php" method="post">
				<div class="user-box">
					<input type="password" name="code" minlength="6" required="">
					<label>Security Code</label>
				</div>
				<div class="w3-text-white" style="font-family: Montserrat; font-weight: lighter;">
					<input type="checkbox" id="show" onclick="password()"> 
					<label id="label" for="show"> Show Code</label>
				</div>
				<input type="hidden" value="security" name="type">
				<input type="hidden" value="<?php echo $id ?>" name="ide">
                <a href="#">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<button class="submit-btn" type="submit">Verify</button>
</a>
			</form>
		</div>
	</body>
</html>
