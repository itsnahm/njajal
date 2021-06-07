<?php
session_start();

include "config.php";

$email = $_POST["email"];
$password = $_POST["password"];

$sql = "SELECT * from akun where email='".$email."' and password='".$password."' limit 1";
$hasil = mysqli_query ($connection,$sql);
$jumlah = mysqli_num_rows($hasil);


	if ($jumlah>0) {
		$row = mysqli_fetch_assoc($hasil);
		$_SESSION["IDAkun"]=$row["IDAkun"];
		$_SESSION["nama"]=$row["nama"];
		$_SESSION["email"]=$row["email"];
		$_SESSION["status"]=$row["status"];


		header("Location:index.php");

	}else {
		echo "Email atau password salah <br><a href='login.php'>Kembali</a>";
	}
?>
