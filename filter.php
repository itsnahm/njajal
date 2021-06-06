<?php
date_default_timezone_set('Asia/Jakarta');
if(!ISSET($_POST['filter'])){
?>
<?php

require 'config.php';
$bulan = 0;
$tahun = 0;
$query = mysqli_query($connection, "SELECT namabarang, sum(totalpembelian) as beli, sum(totalpenjualan) as jual FROM daftarbarang daf join pembelian pem join penjualan pen on daf.IDBarang = pem.IDBarang = pen.IDBarang WHERE (MONTH(tanggalbeli) AND MONTH(tanggaljual) = '$bulan') AND (YEAR(tanggalbeli) AND YEAR(tanggaljual) = '$tahun') ");
$no = 1;
while($fetch = mysqli_fetch_array($query)){
 ?>
 <tr>
   <td><?php echo $no++ ?></td>
   <td><?php echo $fetch['namabarang'] ?></td>
   <td><?//php echo date('d M Y', strtotime($fetch['tanggaljual']))?></td>
   <td><?php echo $fetch['beli']; ?></td>
   <td><?php echo $fetch['jual']; ?></td>
 <tr>
 <?php
}
?>

<?php
}
?>

<?php
if(ISSET($_POST['filter'])){
  require 'config.php';
  $bulan = $_POST['bulan'];
  $tahun = $_POST['tahun'];
  $no = 1;
//  $beli = mysqli_query($connection, "SELECT daftarbarang, sum(totalpembelian) as beli from daftarbarang daf join pembelian pem on daf.IDBarang = pem.IDBarang WHERE MONTH(tanggalbeli) = '$bulan' AND YEAR(tanggalbeli) = '$tahun' ");

//  $jual = mysqli_query($connection, "SELECT daftarbarang, sum(totalpembelian) as jual from daftarbarang daf join penjualan pen on daf.IDBarang = pen.IDBarang WHERE MONTH(tanggaljual) = $bulan");
//  $query = mysqli_query($connection, "SELECT * FROM datfarbarang daf join pembelian pem join penjualan pen on daf.IDBarang = pem.IDBarang = pen.IDBarang WHERE MONTH(tanggalbeli) = '$bulan' and MONTH(tanggaljual) = '$bulan'");
$query = mysqli_query($connection, "SELECT namabarang, sum(totalpembelian) as beli, sum(totalpenjualan) as jual FROM daftarbarang daf join pembelian pem join penjualan pen on daf.IDBarang = pem.IDBarang = pen.IDBarang WHERE (MONTH(tanggalbeli) and MONTH(tanggaljual) = '$bulan') AND (YEAR(tanggalbeli) AND YEAR(tanggaljual) = '$tahun') ");
  while($fetch = mysqli_fetch_array($query)){
    ?>
--
  <tr>
    <td><?php echo $no++ ?></td>
    <td><?php echo $fetch['namabarang'] ?></td>
      <td><?php echo $bulan ?></td>
      <td><?php echo "Rp".number_format($fetch['beli']).",-"; ?></td>
      <td><?php echo "Rp".number_format($fetch['jual']).",-"; ?></td>
    </tr>
    <?php
    }
} else {
  echo "Maaf data tidak ditemukan";
}
 ?>
