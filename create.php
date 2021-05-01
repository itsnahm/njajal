<?php
session_start();

include_once "config.php";

if ( !$connection ) {
    echo mysqli_error( $connection );
    throw new Exception( "Database cannot Connect" );
} else {

  $action = $_REQUEST['action'];

    if ( 'tambahAkun' == $action ) {
  //      $IDAkun = $_POST['IDAkun'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $status = $_POST['status'];

        if ( $nama && $email && $password && $status ) {
    //        $hashPassword = password_hash( $password, PASSWORD_BCRYPT );
            $query = "INSERT INTO akun(nama,email,password,status) VALUES ('$nama','$email','$password','$status')";
            mysqli_query( $connection, $query );
            header( "location:index.php?id=akun" );
        }
      } else if ('ubahAkun' == $action) {
        $IDAkun = $_POST['id'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $status = $_POST['status'];

        if ( $nama && $email && $status ) {
    //        $hashPassword = password_hash( $password, PASSWORD_BCRYPT );
            $query = "UPDATE akun SET nama='{$nama}', email='{$email}', status='$status' WHERE IDAkun='{$IDAkun}'";
            mysqli_query( $connection, $query );
            header( "location:index.php?id=akun" );

      }

    }
  }
 ?>
