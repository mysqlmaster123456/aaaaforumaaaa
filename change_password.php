<?php 
$conn = new mysqli("localhost", "root", "", "test");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if($_POST) {
	$email = $_POST['email'];
	$odpoved = $_POST['odpoved'];
	$nove_heslo = $_POST['nove_heslo'];
	

	$sql = "UPDATE users SET heslo = '". md5($nove_heslo) ."' WHERE email = '$email' AND odpoved = '$odpoved';";
	$result = $conn->query($sql);
	if($conn->affected_rows > 0) {
		echo "Heslo bylo změněno.";
		header('Refresh: 3; url=login.php');
		return;
	}
}
echo "Byla zadána špatná odpoveď.";
?>