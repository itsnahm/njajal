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
  $totalnilaiakhir = 0;
  $totallabakotor = 0;
  $totalHPP = 0;

$query = mysqli_query($connection, "SELECT IDBarang as ID, namabarang, (SELECT sum(jumlahbeli) from pembelian WHERE IDBarang = ID and month(tanggalbeli)='$bulan') as jumlahBeli,
(SELECT sum(jumlahjual) from penjualan WHERE IDBarang = ID AND month(tanggaljual)='$bulan') as jumlahJual,

((SELECT sum(jumlahbeli) from pembelian WHERE IDBarang = ID AND month(tanggalbeli)<='$bulan')-(SELECT sum(jumlahjual) from penjualan WHERE IDBarang = ID AND month(tanggaljual)<='$bulan')) as sisaBarang,

((SELECT sum(totalpembelian) from pembelian WHERE IDBarang = ID and month(tanggalbeli)<='$bulan')/(SELECT sum(jumlahbeli) from pembelian WHERE IDBarang = ID AND month(tanggalbeli)<='$bulan')) as hargaPokok,

(((SELECT sum(totalpembelian) from pembelian WHERE IDBarang = ID and month(tanggalbeli)<='$bulan')/(SELECT sum(jumlahbeli) from pembelian WHERE IDBarang = ID AND month(tanggalbeli)<='$bulan'))*((SELECT sum(jumlahbeli) from pembelian WHERE IDBarang = ID AND month(tanggalbeli)<='$bulan')-(SELECT sum(jumlahjual) from penjualan WHERE IDBarang = ID AND month(tanggaljual)<='$bulan'))) as nilaiAkhir,

((SELECT sum(jumlahjual) from penjualan WHERE IDBarang = ID AND month(tanggaljual)='$bulan')*(SELECT sum(totalpembelian) from pembelian WHERE IDBarang = ID and month(tanggalbeli)<='$bulan')/(SELECT sum(jumlahbeli) from pembelian WHERE IDBarang = ID and month(tanggalbeli)<='$bulan')) as HPP,

((SELECT sum(totalpenjualan) from penjualan WHERE IDBarang = ID and month(tanggaljual)='$bulan')-((SELECT sum(jumlahjual) from penjualan WHERE IDBarang = ID AND month(tanggaljual)='$bulan')*(SELECT sum(totalpembelian) from pembelian WHERE IDBarang = ID and month(tanggalbeli)<='$bulan')/(SELECT sum(jumlahbeli) from pembelian WHERE IDBarang = ID and month(tanggalbeli)<='$bulan'))) as labaKotor

FROM daftarbarang
GROUP BY IDBarang
");
  while($fetch = mysqli_fetch_array($query)){

    $totalnilaiakhir += $fetch['nilaiAkhir'];
    $totallabakotor += $fetch['labaKotor'];
    $totalHPP += $fetch['HPP'];
    ?>
  <tr>

    <td><?php echo $no++ ?></td>
    <td><?php echo $fetch['namabarang'] ?></td>
      <td><?php echo number_format($fetch['jumlahBeli'])?></td>
      <td><?php echo number_format($fetch['jumlahJual']) ?></td>
      <td><?php echo number_format($fetch['sisaBarang']); ?></td>
      <td><?php echo "Rp".number_format($fetch['hargaPokok']).",-"; ?></td>
      <td><?php echo "Rp".number_format($fetch['nilaiAkhir']).",-"; ?></td>
      <td><?php echo "Rp".number_format($fetch['HPP']).",-"; ?></td>
      <td><?php echo "Rp".number_format($fetch['labaKotor']).",-"; ?></td>

    </tr>
  <?php

}

   ?>
  <tr>
      <th colspan="6">Total</th>
      <th><?= "Rp".number_format($totalnilaiakhir).",-" ?></th>
      <th><?= "Rp".number_format($totalHPP).",-" ?></th>
      <th><?= "Rp".number_format($totallabakotor).",-" ?></th>
    </tr>
    <?php

}

 ?>
