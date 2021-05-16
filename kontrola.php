<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<link rel="stylesheet" type="text/css" href="style.css">

<body>
	<div class="form">
<h1>Pro změnu hesla odpovězte správně na kontrolní otázu</h1>

<?php
	session_start();

$con = mysqli_connect("localhost", "root", "", "test");
// Check connection
if (mysqli_connect_error())
{
    echo "Selhalo spojení s MySQL: " . mysqli_connect_error();
    
}



	if (isset($_POST['submit'])){
		 $email = stripslashes($_REQUEST['email']);
    //escapes special characters in a string
    $email = mysqli_real_escape_string($con, $email);
	$kontrolni_otazka = stripcslashes($_POST['kontrolni_otazka']);
	$kontrolni_otazka = mysqli_real_escape_string($con,$kontrolni_otazka);
	$odpoved = stripcslashes($_POST['odpoved']);
	$odpoved = mysqli_real_escape_string($con,$odpoved);
    $query = "SELECT * FROM users WHERE kontrolni_otazka = '$kontrolni_otazka' and odpoved = '$odpoved'";
  	
  	$result = mysqli_query($con, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if ($rows == 1)
    {
        // Redirect user to index.php
       header("Location: update_heslo.php");
    }
    else
    {
        echo "<div class='form'>
<h3>Zadali jste špatnou otázku nebo odpověď</h3>";
    }


}

?>
<form action="" method="POST">
<input type="text" name="kontrolni_otazka" placeholder="Kontrolní otázka" required />
<input type="text" name="odpoved" placeholder="Odpověď" required />
<input type="submit" name="submit" value="Odeslat" />
</form>
</div>
</div>
</body>
</html>