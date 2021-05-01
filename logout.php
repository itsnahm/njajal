<?php
session_start();

$_SESSION['IDAkun']='';
$_SESSION['nama']='';
$_SESSION['email']='';
$_SESSION['status']='';

unset($_SESSION['IDAkun']);
unset($_SESSION['nama']);
unset($_SESSION['email']);
unset($_SESSION['status']);

session_unset();
session_destroy();
header('Location:login.php');

?>
