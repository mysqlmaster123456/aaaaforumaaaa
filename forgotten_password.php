<?php
	if($_POST) {
		$email = $_POST['email'];

		
		$conn = new mysqli("localhost", "root", "", "test");
		
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT kontrolni_otazka FROM users WHERE email = '$email';";
		$result = $conn->query($sql);

		if ($result && $result->num_rows == 1) {
		 
		  $row = $result->fetch_assoc();
		  $kontrolni_otazka = $row['kontrolni_otazka'];
		} else {
			$error = true;
		}
		$conn->close();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<link rel="stylesheet" type="text/css" href="style.css">

<body>
<div class="form">
	<h1>Zapomenuté heslo</h1>
	<?php
		if(!$_POST || isset($error)) {
	?>
	<form action="" method="POST">
		Email: <input type="email" name="email" placeholder="Email" required />
		<input type="submit" name="submit" value="Odeslat" />
	</form>
	<?php
			if(isset($error)) {
				echo "Uživatel s tímto emailem nebyl nazelen.";
			}
		} else {
	?>
	<form action="change_password.php" method="POST">
		<?php echo $kontrolni_otazka ?>: <input type="text" name="odpoved" placeholder="Odpověď" required /><br>
		Nové heslo: <input type="password" id="nove_heslo" name="nove_heslo" placeholder="Nové heslo" required /><br>
		Znovu nové heslo: <input type="password" id="znovu_nove_heslo" placeholder="Znovu nové heslo" required /><br>
		<input type="hidden" name="email" value="<?php echo $email ?>">
		<input type="submit" name="submit" value="Změnit heslo" />
	</form>
<?php } ?>
</div>
</body>
</html>