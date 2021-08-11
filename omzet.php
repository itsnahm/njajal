<?php
date_default_timezone_set('Asia/Jakarta');
if(!ISSET($_POST['omzet'])){
?>
<?php

require 'config.php';
$bulan = 0;
$tahun = 0;
$query = mysqli_query($connection, "SELECT month(tanggaljual) as bulan, year(tanggaljual) as tahun, sum(totalpenjualan) as jual FROM penjualan WHERE (MONTH(tanggaljual) = '$bulan') AND (YEAR(tanggaljual) = '$tahun')");
$no = 1;
while($fetch = mysqli_fetch_array($query)){
 ?>
 <tr>
   <td><?php echo $no++ ?></td>
   <td><?php echo $fetch['bulan'] ?></td>
   <td><?php echo $fetch['tahun']; ?></td>
   <td><?php echo $fetch['jual']; ?></td>


 <tr>


<?php
}
}
?>

<?php
if(ISSET($_POST['omzet'])){
  require 'config.php';
  $bulan = $_POST['bulan'];
  $tahun = $_POST['tahun'];
  $query = mysqli_query($connection, "SELECT month(tanggaljual) as bulan, year(tanggaljual) as tahun, sum(totalpenjualan) as jual FROM penjualan WHERE (MONTH(tanggaljual) = '$bulan') AND (YEAR(tanggaljual) = '$tahun')");
  $no = 1;
  while($fetch = mysqli_fetch_array($query)){
   ?>
   <tr>
     <td><?php echo $no++ ?></td>
     <td><?php echo $fetch['bulan'] ?></td>
     <td><?php echo $fetch['tahun']; ?></td>
     <td><?php echo "Rp".number_format($fetch['jual']).",-"; ?></td>


   <tr>
    <?php

}
}

 ?>
