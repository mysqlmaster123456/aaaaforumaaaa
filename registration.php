<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<link rel="stylesheet" type="text/css" href="style.css">

<body>
	<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="POST">
<input type="text" name="jmeno" placeholder="Jméno" required />
<input type="text" name="prijmeni" placeholder="Příjmení" required />
<input type="text" name="nick" placeholder="Nickname" required />
<input type="password" name="heslo" placeholder="Heslo" required />
<input type="password" name="kontrola_hesla" placeholder="Kontrola hesla" required />
<input type="email" name="email" placeholder="Email" required />
<input type="text" name="poznamka" placeholder="Poznámka"  />
<input type="text" name="kontrolni_otazka" placeholder="Kontrolní otázka" required />
<input type="text" name="odpoved" placeholder="Odpověď na kontrolní otázku" required />
<input type="submit" name="submit" value="Register" />
<a href="login.php"> Přihlásit se</a>
</form>
</div>
</div>
</body>
</html>
	<?php
	session_start();

$con = mysqli_connect("localhost","root","","test");
// Check connection
if (mysqli_connect_error())
  {
  echo "Selhalo spojení s MySQL: " . mysqli_connect_error();
  }

//Jestliže odeslaný form insertuje do db
if (isset($_POST['submit'])) {
	$jmeno = stripcslashes($_POST['jmeno']);
	$jmeno = mysqli_real_escape_string($con,$jmeno);
	$prijmeni = stripcslashes($_POST['prijmeni']);
	$prijmeni = mysqli_real_escape_string($con,$prijmeni);
	$nick = stripcslashes($_POST['nick']);
	$nick = mysqli_real_escape_string($con,$nick);
	$heslo = stripcslashes($_POST['heslo']);
	$heslo = mysqli_real_escape_string($con,$heslo);
	$kontrola_hesla = stripcslashes($_POST['kontrola_hesla']);
	$kontrola_hesla = mysqli_real_escape_string($con,$kontrola_hesla);
	$email = stripcslashes($_POST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$poznamka = stripcslashes($_POST['poznamka']);
	$poznamka = mysqli_real_escape_string($con,$poznamka);
	$kontrolni_otazka = stripcslashes($_POST['kontrolni_otazka']);
	$kontrolni_otazka = mysqli_real_escape_string($con,$kontrolni_otazka);
	$odpoved = stripcslashes($_POST['odpoved']);
	$odpoved = mysqli_real_escape_string($con,$odpoved);

	$sql_u = "SELECT * FROM users WHERE nick='$nick'";
  	$sql_e = "SELECT * FROM users WHERE email='$email'";
  	$res_u = mysqli_query($con, $sql_u);
  	$res_e = mysqli_query($con, $sql_e);

  	if (mysqli_num_rows($res_u) > 0) {
  	  echo "Sorry... Nickname already taken"; 	
  	}else if(mysqli_num_rows($res_e) > 0){
  	  echo "Sorry... email already taken"; 	
  	 }else
	 if ($_POST["heslo"] !== $_POST["kontrola_hesla"]) {
	 	echo "hesla se neshodují";
	 } else {
	$query = "INSERT INTO users (jmeno, prijmeni, nick, heslo, email, poznamka, kontrolni_otazka, odpoved) VALUES ('$jmeno', '$prijmeni', '$nick', '".md5($heslo)."',
	 '$email', '$poznamka', '$kontrolni_otazka', '$odpoved')";
	$result = mysqli_query($con, $query);
	if ($result) {	
		echo"JSME TAM ZMRDE";
        }
    }
}
?>
