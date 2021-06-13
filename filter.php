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

$query = mysqli_query($connection, "SELECT daftarbarang.IDBarang as ID, namabarang,
tanggalbeli,
sum(jumlahbeli) as jumlahBeli,
(SELECT sum(jumlahjual) from penjualan JOIN daftarbarang on daftarbarang.IDBarang = penjualan.IDBarang WHERE month(tanggaljual) = '$bulan' AND YEAR(tanggaljual) = '$tahun' AND penjualan.IDBarang = ID ) as jumlahJual,
(sum(pembelian.jumlahbeli)-(SELECT sum(jumlahjual) from penjualan JOIN daftarbarang on daftarbarang.IDBarang = penjualan.IDBarang WHERE month(tanggaljual) = '$bulan' AND YEAR(tanggaljual) = '$tahun' AND penjualan.IDBarang = ID )) as sisaBarang,
(sum(totalpembelian)/sum(pembelian.jumlahbeli)) as hargaPokok,
((sum(totalpembelian)/sum(pembelian.jumlahbeli))*(sum(pembelian.jumlahbeli)-(SELECT sum(jumlahjual) from penjualan JOIN daftarbarang on daftarbarang.IDBarang = penjualan.IDBarang WHERE month(tanggaljual) = '$bulan' AND YEAR(tanggaljual) = '$tahun' AND penjualan.IDBarang = ID ))) as nilaiAkhir,
((sum(totalpembelian))-((sum(totalpembelian)/sum(pembelian.jumlahbeli))*(sum(pembelian.jumlahbeli)-(SELECT sum(jumlahjual) from penjualan JOIN daftarbarang on daftarbarang.IDBarang = penjualan.IDBarang WHERE month(tanggaljual) = '$bulan' AND YEAR(tanggaljual) = $tahun AND penjualan.IDBarang = ID )))) as HPP,
((SELECT sum(totalpenjualan) FROM penjualan WHERE penjualan.IDBarang = ID and month(tanggaljual) = '$bulan' AND YEAR(tanggaljual) = '$tahun') - ((sum(totalpembelian))-((sum(totalpembelian)/sum(pembelian.jumlahbeli))*(sum(pembelian.jumlahbeli)-(SELECT sum(jumlahjual) from penjualan JOIN daftarbarang on daftarbarang.IDBarang = penjualan.IDBarang WHERE month(tanggaljual) = '$bulan' AND YEAR(tanggaljual) = '$tahun' AND penjualan.IDBarang = ID ))))) as labaKotor,
(SELECT sum(jumlahjual) from penjualan WHERE month(tanggaljual) = '$bulan' AND YEAR(tanggaljual) = '$tahun' AND penjualan.IDBarang = ID ) as jumlahJual
FROM daftarbarang
JOIN pembelian
ON daftarbarang.IDBarang = pembelian.IDBarang
WHERE month(tanggalbeli) = '$bulan' AND YEAR(tanggalbeli) = '$tahun'
GROUP BY daftarbarang.IDBarang
");
  while($fetch = mysqli_fetch_array($query)){

    $totalnilaiakhir += $fetch['nilaiAkhir'];
    $totallabakotor += $fetch['labaKotor'];
    $totalHPP += $fetch['HPP'];
    ?>
  <tr>

    <td><?php echo $no++ ?></td>
    <td><?php echo $fetch['namabarang'] ?></td>
      <td><?php echo date('M', strtotime($fetch['tanggalbeli']))?></td>
      <td><?php echo $fetch['jumlahJual'] ?></td>
      <td><?php echo $fetch['sisaBarang']; ?></td>
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
//SELECT namabarang, jumlahbarang, tanggalbeli, sum(totalpembelian) as beli, sum(totalpenjualan) as jual
//FROM daftarbarang daf JOIN pembelian pem ON pem.IDBarang = daf.IDBarang
//JOIN penjualan pen ON pen.IDBarang = daf.IDBarang
//WHERE MONTH(tanggalbeli) = '$bulan' AND YEAR(tanggalbeli) = '$tahun' GROUP BY namabarang
 ?>
