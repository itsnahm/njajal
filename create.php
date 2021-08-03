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
    $IDAkun = $_REQUEST['pengguna'];

    if ($namabarang && $tanggalbeli && $jumlahbeli && $hargabeli && $totalbeli && $IDAkun) {
      $query = "INSERT INTO pembelian(IDBarang,jumlahbeli,tanggalbeli,hargabeli,totalpembelian,IDAkun) VALUES ('{$namabarang}','$jumlahbeli','$tanggalbeli','$hargabeli','$totalbeli','$IDAkun')";
      mysqli_query( $connection, $query );
      header( "location:index.php?id=pembelian" );
    }
  } else if ('ubahBeli' == $action) {
    $IDBeli = $_POST['id'];
    $namabarang = $_POST['namabarang'];
    $tanggalbeli = $_POST['tanggalbeli'];
    $jumlahbeli = $_POST['jumlahbeli'];
    $hargabeli = $_POST['hargabeli'];
    $totalbeli = $_POST['totalbeli'];
    $IDAkun = $_POST['pengguna'];
  } if ($namabarang && $tanggalbeli && $jumlahbeli && $hargabeli && $totalbeli && $IDAkun) {
    $query = "UPDATE pembelian SET IDBarang='{$namabarang}', jumlahbeli='{$jumlahbeli}', tanggalbeli='$tanggalbeli', hargabeli='$hargabeli', totalpembelian='$totalbeli', IDAkun='$IDAkun' WHERE IDBeli='{$IDBeli}'";
    mysqli_query( $connection, $query );
    header( "location:index.php?id=pembelian" );


  } else if ('tambahjual' == $action) {
    $namabarang = $_REQUEST['namabarang'] ?? '';
    $tanggaljual = $_REQUEST['tanggaljual'] ?? '';
    $jumlahjual = $_REQUEST['jumlahjual'] ?? '';
    $hargajual = $_REQUEST['hargajual'] ?? '';
    $totaljual = $_REQUEST['totaljual'] ?? '';
    $IDAkun = $_REQUEST['pengguna'] ?? '';

   if ($namabarang && $tanggaljual && $jumlahjual && $hargajual && $totaljual && $IDAkun) {
    $query = "INSERT INTO penjualan(IDBarang,jumlahjual,tanggaljual,hargajual,totalpenjualan,IDAkun) VALUES ('{$namabarang}','$jumlahjual','$tanggaljual','$hargajual','$totaljual','$IDAkun')";
    mysqli_query( $connection, $query );
    header( "location:index.php?id=penjualan" );
  }
} else if ('ubahJual' == $action) {
  $IDJual = $_POST['id'];
  $namabarang = $_POST['namabarang'];
  $tanggaljual = $_POST['tanggaljual'];
  $jumlahjual = $_POST['jumlahjual'];
  $hargajual = $_POST['hargajual'];
  $totaljual = $_POST['totaljual'];
  $IDAkun = $_POST['pengguna'];
} if ($namabarang && $tanggaljual && $jumlahjual && $hargajual && $totaljual) {
  $query = "UPDATE penjualan SET IDBarang='{$namabarang}', jumlahjual='{$jumlahjual}', tanggaljual='$tanggaljual', hargajual='$hargajual', totalpenjualan='$totaljual', IDAkun='$IDAkun' WHERE IDJual='{$IDJual}'";
  mysqli_query( $connection, $query );
  header( "location:index.php?id=penjualan" );
}

 if ('profilKaryawan' == $action) {
  $IDAkun = $_POST['id'];
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $passwordbaru = $_POST['passwordbaru'];
  $passwordlama = $_POST['passwordlama'];
  $data = mysqli_query($connection, "SELECT password FROM akun where IDAkun = '$IDAkun'");
  while ($a = mysqli_fetch_array($data)) {
    if ($passwordlama != $a['password']) {
      echo "<script>alert('Password yang dimasukkan salah!');history.go(-1);</script>";
    } else {
      $query = "UPDATE akun SET nama='{$nama}', email='{$email}', password='{$passwordbaru}' WHERE IDAkun='{$IDAkun}'";
      mysqli_query( $connection, $query );
      header( "location:index.php?id=profilKaryawan" );
    }
  }
}

}
 ?>
