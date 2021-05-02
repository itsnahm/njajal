<?php
session_start();

include "config.php";
//$connection = mysqli_connect($host,$user,$password,$db);
if ( !$connection ) {
    echo mysqli_error( $connection );
    throw new Exception( "Database cannot Connect" );
} else {

  $action = $_REQUEST['action'];

    if ( 'tambahakun' == $action ) {
  //      $IDAkun = $_POST['IDAkun'];
        $nama = $_REQUEST['nama'] ?? '';
        $email = $_REQUEST['email'] ?? '';
        $password = $_REQUEST['password'] ?? '';
        $status = $_REQUEST['status'] ?? '';

        if ($nama && $email && $password && $status) {
    //        $hashPassword = password_hash( $password, PASSWORD_BCRYPT );
    $query = "INSERT INTO akun(nama,email,password,status) VALUES ('{$nama}','$email','$password','$status')";
    mysqli_query( $connection, $query );
    header( "location:index.php?id=akun" );
}

    }   else if ('ubahAkun' == $action) {
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

    } else if ('tambahBarang' == $action) {
      $namabarang = $_REQUEST['namabarang'] ?? '';
      $satuan = $_REQUEST['satuan'] ?? '';
        $kategori = $_REQUEST['kategori'] ?? '';

        if ( $namabarang && $satuan && $kategori ) {
            $query = "INSERT INTO daftarbarang(namabarang,satuan,kategori) VALUES ('{$namabarang}','$satuan','$kategori')";
            mysqli_query( $connection, $query );
            header( "location:index.php?id=daftarBarang" );
        }

    } else if ('ubahBarang' == $action) {
        $IDBarang = $_POST['id'];
        $namabarang = $_POST['namabarang'];
        $satuan = $_POST['satuan'];
        $kategori = $_POST['kategori'];

        if ( $namabarang && $satuan && $kategori ) {
    //        $hashPassword = password_hash( $password, PASSWORD_BCRYPT );
            $query = "UPDATE daftarbarang SET namabarang='{$namabarang}', satuan='{$satuan}', kategori='$kategori' WHERE IDBarang='{$IDBarang}'";
            mysqli_query( $connection, $query );
            header( "location:index.php?id=daftarBarang" );
            }
  } else if ('tambahbeli' == $action) {
    $namabarang = $_REQUEST['namabarang'] ?? '';
    $tanggalbeli = $_REQUEST['tanggalbeli'] ?? '';
    $jumlahbeli = $_REQUEST['jumlahbeli'] ?? '';
    $hargabeli = $_REQUEST['hargabeli'] ?? '';
    $totalbeli = $_REQUEST['totalbeli'] ?? '';

    if ($nama && $tanggalbeli && $jumlahbeli && $hargabeli && $totalbeli) {
      $query = "INSERT INTO pembelian(IDBarang,,password,status) VALUES ('{$nama}','$email','$password','$status')";
      mysqli_query( $connection, $query );
      header( "location:index.php?id=pembelian" );
    }
  }
}
 ?>
