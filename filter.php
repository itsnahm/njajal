<?php
date_default_timezone_set('Asia/Jakarta');
if(!ISSET($_POST['filter'])){
?>
<?php

require 'config.php';
$bulan = 0;
$tahun = 0;
$query = mysqli_query($connection, "SELECT namabarang, sum(totalpembelian) as beli FROM daftarbarang daf join pembelian pem on daf.IDBarang = pem.IDBarang WHERE (MONTH(tanggalbeli) = '$bulan') AND (YEAR(tanggalbeli) = '$tahun')   ");
$no = 1;
while($fetch = mysqli_fetch_array($query)){
 ?>
 <tr>
   <td><?php echo $no++ ?></td>
   <td><?php echo $fetch['namabarang'] ?></td>
   <td></td>
   <td><?php echo $fetch['beli']; ?></td>

   <td><?php //echo $fetch['jual']; ?></td>
 <tr>


<?php
}
}
?>

<?php
if(ISSET($_POST['filter'])){
  require 'config.php';
  $bulan = $_POST['bulan'];
  $tahun = $_POST['tahun'];
  $no = 1;

$query = mysqli_query($connection, "SELECT namabarang, jumlahbarang, tanggalbeli, sum(totalpembelian) as beli, sum(totalpenjualan) as jual
FROM daftarbarang daf JOIN pembelian pem ON pem.IDBarang = daf.IDBarang
JOIN penjualan pen ON pen.IDBarang = daf.IDBarang
WHERE MONTH(tanggalbeli) = '$bulan' AND YEAR(tanggalbeli) = '$tahun' GROUP BY namabarang ");
  while($fetch = mysqli_fetch_array($query)){
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
    <td><?php echo $fetch['namabarang'] ?></td>
      <td><?php echo date('M', strtotime($fetch['tanggalbeli']))?></td>
      <td><?php echo $fetch['jumlahbarang'] ?></td>
      <td><?php echo "Rp".number_format($fetch['beli']).",-"; ?></td>
      <td><?php echo "Rp".number_format($fetch['jual']).",-"; ?></td>
    </tr>
    <?php
}
}
 ?>
