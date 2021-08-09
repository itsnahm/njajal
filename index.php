<?php
session_start();

if (!isset($_SESSION["email"])) {
	header( "location:login.php" );
	die();
}

$ID=$_SESSION["IDAkun"];
$nama=$_SESSION["nama"];
$email=$_SESSION["email"];
$status=$_SESSION["status"];

ob_start();

include_once "config.php";
//$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
if ( !$connection ) {
		echo mysqli_error( $connection );
		throw new Exception( "Database cannot Connect" );
}

$id = $_REQUEST['id'] ?? 'dashboard';
$action = $_REQUEST['action'] ?? '';

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIA Putra HM 4 Elektronik</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="theme/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="theme/dist/css/adminlte.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="theme/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

</head>

<div class="topber__title">
		<span class="topber__title--text">
				<?php
				$page = "";
						if ( 'dashboard' == $id ) {
								$page = "Dashboard";
						} elseif ( 'daftarBarang' == $id ) {
								$page = "Daftar Barang";
						} elseif ( 'tambahBarang' == $id ) {
									$page = "Tambah Barang";
						} elseif ( 'ubahBarang' == $action ) {
								$page = "Ubah Barang";
						} elseif ( 'akun' == $id ) {
								$page = "Daftar akun";
						} elseif ( 'penjualan' == $id ) {
								$page = "Data Penjualan";
						} elseif ( 'tambahJual' == $id ) {
								$page = "Tambah Penjualan Barang";
						}	elseif ( 'ubahJual' == $action ) {
								$page = "Ubah Penjualan";
						} elseif ( 'hapusJual' == $action ) {
								$page = "Hapus Penjualan";
						} elseif ( 'pembelian' == $id ) {
								$page = "Data Pembelian";
						} elseif ( 'tambahBeli' == $id ) {
								$page = "Tambah Pembelian Barang";
						} elseif ( 'ubahBeli' == $action ) {
								$page = "Ubah Pembelian";
						} elseif ( 'hapusBeli' == $action ) {
						 		$page = "Hapus beli";
						} elseif ( 'laporan' == $id ) {
								$page = "Laporan Nilai Persediaan";
						} elseif ( 'tambahAkun' == $id ) {
								$page = "Tambah akun";
						} elseif ( 'hapusAkun' == $id ) {
								$page = "Hapus Akun";
						} elseif ( 'ubahAkun' == $action ) {
								$page = "Ubah Akun";
						}	elseif ( 'profilKaryawan' == $id ) {
								$page = "Profil Karyawan";
						}	elseif ( 'profilOwner' == $id ) {
									$page = "Profil Owner";
						} elseif ( 'ubahAkunKaryawan' == $action ) {
								$page = "Ubah Profil";
						} elseif ( 'omzet' == $id ) {
								$page = "Omzet Per Bulan";
						}
						$no = 1;
				?>

		</span>
</div>


<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
<li class="nav-item">
	<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
</li>
</ul>

   <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>


  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="theme/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Putra HM 4 Elektronik</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="theme/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo "$nama"; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard

              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="index.php?id=daftarBarang" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Daftar Barang

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?id=penjualan" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Data Penjualan

              </p>
            </a>

          </li>
					<?php if ('Owner' == $status) {?>
          <li class="nav-item">
            <a href="index.php?id=pembelian" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Data Pembelian

              </p>
            </a>

          </li>
				<?php } ?>
					<?php if ('Owner' == $status) {?>
          <li class="nav-item">
            <a href="index.php?id=laporan" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Laporan Nilai Persediaan

              </p>
            </a>

          </li>
					<li class="nav-item">
            <a href="index.php?id=omzet" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Omzet per bulan

              </p>
            </a>

          </li>
				<?php } ?>
				<?php if ('Owner' == $status) { ?>
          <li class="nav-item">
            <a href="index.php?id=akun" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Daftar Akun

              </p>
            </a>

          </li>
				<?php } ?>

<?php if ('Karyawan' == $status) { ?>
				<li class="nav-item">
					<a href="index.php?id=profilKaryawan" class="nav-link">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Profil

						</p>
					</a>

				</li>
<?php } ?>
<?php if ('Owner' == $status) { ?>
				<li class="nav-item">
					<a href="index.php?id=profilOwner" class="nav-link">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Profil

						</p>
					</a>

				</li>
<?php } ?>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p>
                Keluar

              </p>
            </a>

          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">SIA Persediaan Putra HM 4 Elektronik</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><?php echo "$page"; ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<?php if ('dashboard' == $id) {?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
				<div class="row">
					<div class="col-lg-3 col-6">
						<!-- small box -->
						<div class="small-box bg-info">
							<div class="inner">
								<h3>

<?php
$query = "SELECT COUNT(*) totalBarang FROM daftarbarang;";
$result = mysqli_query ($connection, $query);
$totalBarang = mysqli_fetch_assoc($result);
echo $totalBarang['totalBarang'];
 ?>
								</h3>

								<p>Total Barang</p>
							</div>
							<div class="icon">
								<i class="ion ion-bag"></i>
							</div>
							<a href="index.php?id=daftarBarang" class="small-box-footer">Info lengkap <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-6">
						<!-- small box -->
						<div class="small-box bg-success">
							<div class="inner">
								<h3>53<sup style="font-size: 20px">%</sup></h3>

								<p>Bounce Rate</p>
							</div>
							<div class="icon">
								<i class="ion ion-stats-bars"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-6">
						<!-- small box -->
						<div class="small-box bg-warning">
							<div class="inner">
								<h3>44</h3>

								<p>User Registrations</p>
							</div>
							<div class="icon">
								<i class="ion ion-person-add"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-6">
						<!-- small box -->
						<div class="small-box bg-danger">
							<div class="inner">
								<h3>65</h3>

								<p>Unique Visitors</p>
							</div>
							<div class="icon">
								<i class="ion ion-pie-graph"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>

<div class="col-lg-3 col-6">
					<a href="index.php?id=tambahBarang"><button type="button" class="btn btn-block btn-danger">+ Tambah barang baru</button></a>
</div>
<?php if ('Owner' == $status) {?>
<div class="col-lg-3 col-6">
				<a href="index.php?id=tambahBeli"><button type="button" class="btn btn-block btn-warning">+ Tambah pembelian baru</button></a>
</div>
<?php } ?>
<div class="col-lg-3 col-6">
					<a href="index.php?id=tambahJual"><button type="button" class="btn btn-block btn-success">+ Tambah penjualan baru</button></a>
</div>
					<!-- ./col -->
				</div>

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
	<?php } ?>

<!-- BARANG!!! -->
	<?php if ('daftarBarang' == $id) {?>
		<section class="content">

			<!-- Default box -->
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><?php echo "$page"; ?></h3>

					<div class="card-tools">
						<a href="index.php?id=tambahBarang"><button type="button" class="btn btn-block btn-danger">+ Tambah barang baru</button></a>

					</div>

				</div>
				<div class="card-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
							<th>No</th>
							<th>Nama Barang</th>
							<th>Satuan</th>
							<th>Kategori</th>
							<th>Jumlah barang</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<?php

						$data = mysqli_query($connection, "SELECT * FROM daftarbarang ORDER BY IDBarang DESC");
						while ($a = mysqli_fetch_array($data)) {

						 ?>
						<tbody>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $a['namabarang']; ?></td>
							<td><?php echo $a['satuan']; ?></td>
							<td><?php echo $a['kategori']?></td>
							<td><?php echo $a['jumlahbarang']; ?></td>
							<td><a href="index.php?action=ubahBarang&id=<?php echo $a['IDBarang'];  ?>">Ubah</a> | <a href="index.php?action=hapusBarang&id=<?php echo $a['IDBarang'];  ?>">Hapus</a></td>
						</tr>
						</tbody>
					<?php } ?>


					</table>
				</div>
				<!-- /.card-body -->

				<!-- /.card-footer-->
			</div>
			<!-- /.card -->

		</section>
	<?php } ?>

<!-- TAMBAH BARANG BARU!!-->
<?php if ('tambahBarang' == $id) { ?>
	<section class="content">

		<!-- Default box -->
		<div class="card card-danger">
			<div class="card-header">
				<h3 class="card-title"><?php echo "$page"; ?></h3>

			</div>
			<div class="card-body">

				<form class="form-horizontal" action="create.php" method="POST">

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-10">
							<input type="text" name="namabarang" class="form-control" id="inputEmail3" placeholder="Nama..." required>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword3" class="col-sm-2 col-form-label">Satuan</label>
						<div class="col-sm-10">

							<select class="form-control" name="satuan">
								<option>Biji</option>
								<option>Meter</option>

							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword3" class="col-sm-2 col-form-label">Kategori</label>
						<div class="col-sm-10">

							<select class="form-control" name="kategori">
								<option>Lampu</option>
								<option>Kabel</option>
								<option>Mic</option>
								<option>Baut</option>

							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah barang</label>
						<div class="col-sm-10">
							<input type="email" name="email" class="form-control" id="inputEmail3" placeholder="0" disabled>
						</div>
					</div>


					<input type="hidden" name="action" value="tambahBarang">

			</div>

			<!-- /.card-body -->
			<div class="card-footer">
				<button type="submit" class="btn btn-danger">Tambah</button>
				<a href="index.php?id=daftarBarang"<button type="submit" class="btn btn-default float-right">Batal</button></a>
			</div>

			</form>
			<!-- /.card-footer-->
		</div>
		<!-- /.card -->

	</section>
<?php } ?>

<!--UBAH BARANG -->
<?php if ('ubahBarang' == $action) {

	$IDBarang = $_REQUEST['id'];
	$ubahBarang = "SELECT * FROM daftarbarang WHERE IDBarang='{$IDBarang}'";
	$result = mysqli_query($connection, $ubahBarang);

	$barang = mysqli_fetch_assoc($result);
	?>
	<section class="content">

		<!-- Default box -->
		<div class="card card-danger">
			<div class="card-header">
				<h3 class="card-title"><?php echo "$page"; ?></h3>

			</div>
			<div class="card-body">

				<form class="form-horizontal" action="create.php" method="POST">

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-10">
							<input type="text" name="namabarang" class="form-control" id="inputEmail3" value="<?php echo $barang['namabarang']; ?>" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword3" class="col-sm-2 col-form-label">Satuan</label>
						<div class="col-sm-10">

							<select class="form-control" name="satuan">
								<option value="Biji" <?php echo $barang['satuan'] == 'Biji' ? 'selected="selected"' : '' ?>>Biji</option>
   							<option value="Meter" <?php echo $barang['satuan'] == 'Meter' ? 'selected="selected"' : '' ?>>Meter</option>


							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword3" class="col-sm-2 col-form-label">Kategori</label>
						<div class="col-sm-10">

							<select class="form-control" name="kategori">
								<option value="Lampu" <?php echo $barang['kategori'] == 'Lampu' ? 'selected="selected"' : '' ?>>Lampu</option>
   							<option value="Kabel" <?php echo $barang['kategori'] == 'Kabel' ? 'selected="selected"' : '' ?>>Kabel</option>
								<option value="Mic" <?php echo $barang['kategori'] == 'Mic' ? 'selected="selected"' : '' ?>>Mic</option>
								<option value="Baut" <?php echo $barang['kategori'] == 'Baut' ? 'selected="selected"' : '' ?>>Baut</option>


							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah barang</label>
						<div class="col-sm-10">
							<input type="email" name="email" class="form-control" id="inputEmail3" value="<?php echo $barang['jumlahbarang']; ?>" disabled>
						</div>
					</div>


					<input type="hidden" name="action" value="ubahBarang">
					<input type="hidden" name="id" value="<?php echo $IDBarang; ?>">

			</div>

			<!-- /.card-body -->
			<div class="card-footer">
				<button type="submit" class="btn btn-danger">Simpan perubahan</button>
				<a href="index.php?id=daftarBarang"<button type="submit" class="btn btn-default float-right">Batal</button></a>
			</div>

			</form>
			<!-- /.card-footer-->
		</div>
		<!-- /.card -->

	</section>
<?php } ?>

<!-- HAPUS BARANG -->
		<?php if ( 'hapusBarang' == $action ) {
                        $IDBarang = $_REQUEST['id'];
                        $hapus = "DELETE FROM daftarbarang WHERE IDBarang ='{$IDBarang}'";
                        $result = mysqli_query( $connection, $hapus );
                        header( "location:index.php?id=daftarBarang" );
                }?>

<!-- PENJUALAN!!!!!!! -->
<?php if ('penjualan' == $id) { ?>
	<section class="content">

		<!-- Default box -->
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"><?php echo "$page"; ?></h3>

				<div class="card-tools">
					<a href="index.php?id=tambahJual"><button type="button" class="btn btn-block btn-success">+ Tambah penjualan baru</button></a>

				</div>

			</div>
			<div class="card-body">
				<table id="example1" class="table table-bordered">
					<thead>
					<tr>
						<th>No</th>
						<th>Nama Barang</th>
						<th>Tanggal Jual</th>
						<th>Jumlah Penjualan</th>
						<th>Harga Jual</th>
						<th>Total Harga</th>
						<th>Aktor</th>
						<th>Aksi</th>
					</tr>
					</thead>
					<?php
					$data = mysqli_query($connection, "SELECT * FROM penjualan pen join daftarbarang daf on pen.IDBarang = daf.IDBarang JOIN akun ak ON pen.IDAkun = ak.IDAkun ORDER BY IDJual DESC");
					while ($a = mysqli_fetch_array($data)) {

					 ?>
					<tbody>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $a['namabarang']; ?></td>
						<td><?php echo date('d M Y', strtotime($a['tanggaljual']))?></td>
						<td><?php echo $a['jumlahjual']; ?></td>
						<td><?php echo "Rp".number_format($a['hargajual']).",-"; ?></td>
						<td><?php echo "Rp".number_format($a['totalpenjualan']).",-"; ?></td>
						<td><?php echo $a['nama'] ?></td>
						<td><a href="index.php?action=ubahJual&id=<?php echo $a['IDJual'];  ?>">Ubah</a> | <a href="index.php?action=hapusJual&id=<?php echo $a['IDJual'];  ?>">Hapus</a></td>
					</tr>
				</tbody>
				<?php } ?>


				</table>
			</div>
			<!-- /.card-body -->

		</div>
		<!-- /.card -->
	</section>
<?php } ?>


<!--TAMBAH PENJUALAN BARANG -->
<?php if ('tambahJual' == $id) { ?>
	<section class="content">

		<!-- Default box -->
		<div class="card card-success">
			<div class="card-header">
				<h3 class="card-title"><?php echo "$page"; ?></h3>

			</div>
			<div class="card-body">

		<form class="form-horizontal" action="create.php" method="POST">
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Nama barang</label>
						<div class="col-sm-10">
			<!--				<input type="text" name="namabeli" class="form-control" id="inputEmail3" placeholder="Nama..." required> -->
			<select id="kd_desa" class="form-control" name="namabarang">
					<?php
					$sql = mysqli_query($connection,"SELECT * FROM daftarbarang daf join pembelian pem on daf.IDBarang = pem.IDBarang GROUP by daf.namabarang");
					while ($result = mysqli_fetch_array($sql)) {
					?>
					<option value="<?php echo $result['IDBarang'] ?>"><?php echo $result['namabarang'] ?><?php echo " (Sisa barang = ".$result['jumlahbarang']. ")" ?></option>
					<?php } ?>
				</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword3" class="col-sm-2 col-form-label">Tanggal jual</label>
						<div class="col-sm-10">

							<div class="input-group">

								<input type="date" name="tanggaljual" class="form-control" data-date-format="DD/MM/YYYY" placeholder="dd/mm/yyyy" required autofocus>
							</div>

					</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah jual</label>
						<div class="col-sm-10">
							<input type="number" name="jumlahjual" class="form-control" id="jumlahjual" onkeyup="penjualan();" required>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Harga jual per item</label>
						<div class="col-sm-10">
							<input type="number" name="hargajual" class="form-control" id="hargajual" onkeyup="penjualan();" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Total </label>
						<div class="col-sm-10">
							<input type="number" name="totaljual" class="form-control" id="totaljual" placeholder="Total jual..." readonly>
						</div>
					</div>
					<input type="hidden" name="action" value="tambahjual">
					<input type="hidden" name="pengguna" value="<?php echo $ID; ?>">

			</div>

			<!-- /.card-body -->
			<div class="card-footer">
				<button type="submit" name="beli" class="btn btn-success">Tambah</button>
				<a href="index.php?id=penjualan"<button type="submit" class="btn btn-default float-right">Batal</button></a>
			</div>

			</form>
			<!-- /.card-footer-->
		</div>
		<!-- /.card -->

	</section>
<?php } ?>

<!--UBAH PENJUALAN -->
<?php if ('ubahJual' == $action) {
	$IDJual = $_REQUEST['id'];
	$ubahJual = "SELECT * FROM penjualan WHERE IDJual='{$IDJual}'";
	$result = mysqli_query($connection, $ubahJual);

	$jual = mysqli_fetch_assoc($result);
	 ?>
	<section class="content">

		<!-- Default box -->
		<div class="card card-success">
			<div class="card-header">
				<h3 class="card-title"><?php echo "$page"; ?></h3>

			</div>
			<div class="card-body">

		<form class="form-horizontal" action="create.php" method="POST">
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Nama barang</label>
						<div class="col-sm-10">
			<!--				<input type="text" name="namabeli" class="form-control" id="inputEmail3" placeholder="Nama..." required> -->
			<select id="kd_desa" class="form-control" name="namabarang">
					<?php
					$sql = mysqli_query($connection,"SELECT * FROM daftarbarang daf join pembelian pem on daf.IDBarang = pem.IDBarang  GROUP by daf.namabarang");
					while ($result = mysqli_fetch_array($sql)) {
					?>
					<option value="<?php echo $result['IDBarang'] ?>"><?php echo $result['namabarang'] ?><?php echo " (Sisa barang = ".$result['jumlahbarang']. ")" ?></option>
					<?php } ?>
				</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword3" class="col-sm-2 col-form-label">Tanggal jual</label>
						<div class="col-sm-10">

							<div class="input-group">

								<input type="date" name="tanggaljual" class="form-control" data-date-format="DD/MM/YYYY" placeholder="dd/mm/yyyy" value="<?php echo $jual['tanggaljual'] ?>" required autofocus>
							</div>

					</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah jual</label>
						<div class="col-sm-10">
							<input type="number" name="jumlahjual" class="form-control" id="jumlahjual" onkeyup="penjualan();" value="<?php echo $jual['jumlahjual'] ?>" required>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Harga jual per item</label>
						<div class="col-sm-10">
							<input type="number" name="hargajual" class="form-control" id="hargajual" onkeyup="penjualan();" value="<?php echo $jual['hargajual'] ?>" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Total </label>
						<div class="col-sm-10">
							<input type="number" name="totaljual" class="form-control" id="totaljual" placeholder="Total jual..." value="<?php echo $jual['totalpenjualan'] ?>" readonly>
						</div>
					</div>
					<input type="hidden" name="action" value="ubahJual">
					<input type="hidden" name="id" value="<?php echo $IDJual; ?>">
					<input type="hidden" name="pengguna" value="<?php echo $ID; ?>">

			</div>

			<!-- /.card-body -->
			<div class="card-footer">
				<button type="submit" name="beli" class="btn btn-success">Simpan perubahan</button>
				<a href="index.php?id=penjualan"<button type="submit" class="btn btn-default float-right">Batal</button></a>
			</div>

			</form>
			<!-- /.card-footer-->
		</div>
		<!-- /.card -->

	</section>
<?php } ?>

<!-- HAPUS PENJUALAN -->
		<?php if ( 'hapusJual' == $action ) {
                        $IDJual = $_REQUEST['id'];
                        $hapus = "DELETE FROM penjualan WHERE IDJual ='{$IDJual}'";
                        $result = mysqli_query( $connection, $hapus );
                        header( "location:index.php?id=penjualan" );
                }?>

<?php if ('Owner' == $status) {?>
<!-- PEMBELIAN!!!!!-->
<?php if ('pembelian' == $id) { ?>
	<section class="content">

		<!-- Default box -->
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"><?php echo "$page"; ?></h3>

				<div class="card-tools">
					<a href="index.php?id=tambahBeli"><button type="button" class="btn btn-block btn-warning">+ Tambah pembelian baru</button></a>

				</div>

			</div>
			<div class="card-body">
				<table id="example1" class="table table-bordered">
					<thead>
					<tr>
						<th>No</th>
						<th>Nama Barang</th>
						<th>Tanggal Beli</th>
						<th>Jumlah beli</th>
						<th>Harga beli</th>
						<th>Total harga</th>
						<th>Aktor</th>
						<th>Aksi</th>
					</tr>
					</thead>
					<?php

					$data = mysqli_query($connection, "SELECT * FROM pembelian pem join daftarbarang daf on pem.IDBarang = daf.IDBarang JOIN akun ak on pem.IDAkun = ak.IDAkun ORDER BY IDBeli DESC");
					while ($a = mysqli_fetch_array($data)) {

					 ?>
					<tbody>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $a['namabarang']; ?></td>
						<td><?php echo date('d M Y', strtotime($a['tanggalbeli']))?></td>
						<td><?php echo $a['jumlahbeli']; ?></td>
						<td><?php echo "Rp".number_format($a['hargabeli']).",-"; ?></td>
						<td><?php echo "Rp".number_format($a['totalpembelian']).",-"; ?></td>
						<td><?php echo $a['nama']; ?></td>
						<td><a href="index.php?action=ubahBeli&id=<?php echo $a['IDBeli'];  ?>">Ubah</a> | <a href="index.php?action=hapusBeli&id=<?php echo $a['IDBeli'];  ?>">Hapus</a></td>
					</tr>
				</tbody>
				<?php } ?>


				</table>
			</div>

		</div>
		<!-- /.card -->
	</section>
<?php } ?>
<?php } ?>

<?php if ('Owner' == $status) {?>
<!-- TAMBAH PEMBELIAN BARANG -->
<?php if ('tambahBeli' == $id) { ?>
	<section class="content">

		<!-- Default box -->
		<div class="card card-warning">
			<div class="card-header">
				<h3 class="card-title"><?php echo "$page"; ?></h3>

			</div>
			<div class="card-body">

		<form class="form-horizontal" action="create.php" method="POST">
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Nama barang</label>
						<div class="col-sm-10">
			<!--				<input type="text" name="namabeli" class="form-control" id="inputEmail3" placeholder="Nama..." required> -->
			<select id="kd_desa" class="form-control" name="namabarang">
					<?php
					$sql = mysqli_query($connection,"SELECT * FROM daftarbarang");
					while ($result = mysqli_fetch_array($sql)) {
					?>
					<option value="<?php echo $result['IDBarang'] ?>"><?php echo $result['namabarang'] ?></option>
					<?php } ?>
				</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword3" class="col-sm-2 col-form-label">Tanggal beli</label>
						<div class="col-sm-10">

							<div class="input-group">

								<input type="date" name="tanggalbeli" class="form-control" data-format="DD/MM/YYYY" placeholder="dd/mm/yyyy" required autofocus>
							</div>

					</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah beli</label>
						<div class="col-sm-10">
							<input type="number" name="jumlahbeli" class="form-control" id="jumlahbeli" onkeyup="perkalian();" required>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Harga beli per item</label>
						<div class="col-sm-10">
							<input type="number" name="hargabeli" class="form-control" id="hargabeli" onkeyup="perkalian();" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Total </label>
						<div class="col-sm-10">
							<input type="number" name="totalbeli" class="form-control" id="totalbeli" placeholder="Total beli..." readonly>
						</div>
					</div>
					<input type="hidden" name="pengguna" value="<?php echo $ID; ?>">
					<input type="hidden" name="action" value="tambahbeli">

			</div>

			<!-- /.card-body -->
			<div class="card-footer">
				<button type="submit" name="beli" class="btn btn-warning">Tambah</button>
				<a href="index.php?id=pembelian"<button type="submit" class="btn btn-default float-right">Batal</button></a>
			</div>

			</form>
			<!-- /.card-footer-->
		</div>
		<!-- /.card -->

	</section>
<?php } ?>
<?php } ?>

<?php if ('Owner' == $status) {?>
<!-- UBAH PEMBELIAN -->
<?php if ('ubahBeli' == $action) {
$IDBeli = $_REQUEST['id'];
$ubahBeli = "SELECT * FROM pembelian WHERE IDBeli='{$IDBeli}'";
$result = mysqli_query($connection, $ubahBeli);

$beli = mysqli_fetch_assoc($result);
	  ?>

	<section class="content">

		<!-- Default box -->
		<div class="card card-warning">
			<div class="card-header">
				<h3 class="card-title"><?php echo "$page"; ?></h3>

			</div>
			<div class="card-body">

		<form class="form-horizontal" action="create.php" method="POST">
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Nama barang</label>
						<div class="col-sm-10">
			<!--				<input type="text" name="namabeli" class="form-control" id="inputEmail3" placeholder="Nama..." required> -->
			<select id="kd_desa" class="form-control" name="namabarang" >

				<?php
				$sql = mysqli_query($connection,"SELECT * FROM daftarbarang");
				while ($result = mysqli_fetch_array($sql)) {
				?>
				<option value="<?php echo $result['IDBarang'] ?>"><?php echo $result['namabarang'] ?></option>
				<?php } ?>
				</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword3" class="col-sm-2 col-form-label">Tanggal beli</label>
						<div class="col-sm-10">

							<div class="input-group">

								<input type="date" name="tanggalbeli" class="form-control" data-date-format="DD/MM/YYYY" placeholder="dd/mm/yyyy" value="<?php echo $beli['tanggalbeli'] ?>" required autofocus>
							</div>

					</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah beli</label>
						<div class="col-sm-10">
							<input type="number" name="jumlahbeli" class="form-control" id="jumlahbeli" onkeyup="perkalian();" value="<?php echo $beli['jumlahbeli']; ?>" required>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Harga beli</label>
						<div class="col-sm-10">
							<input type="number" name="hargabeli" class="form-control" id="hargabeli" onkeyup="perkalian();" value="<?php echo $beli['hargabeli'] ?>" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Total </label>
						<div class="col-sm-10">
							<input type="number" name="totalbeli" class="form-control" id="totalbeli" placeholder="Total beli..." value="<?php echo $beli['totalpembelian'] ?>" readonly>
						</div>
					</div>
					<input type="hidden" name="action" value="ubahBeli">
					<input type="hidden" name="id" value="<?php echo $IDBeli; ?>">
					<input type="hidden" name="pengguna" value="<?php echo $ID; ?>">

			</div>

			<!-- /.card-body -->
			<div class="card-footer">
				<button type="submit" name="beli" class="btn btn-warning">Simpan perubahan</button>
				<a href="index.php?id=pembelian"<button type="submit" class="btn btn-default float-right">Batal</button></a>
			</div>

			</form>
			<!-- /.card-footer-->
		</div>
		<!-- /.card -->

	</section>
<?php } ?>
<?php } ?>

<!--HAPUS BELI -->
<?php if ( 'hapusBeli' == $action ) {
										$IDBeli = $_REQUEST['id'];
										$hapus = "DELETE FROM pembelian WHERE IDBeli ='{$IDBeli}'";
										$result = mysqli_query( $connection, $hapus );
										header( "location:index.php?id=pembelian" );
						}?>

<?php if ('Owner' == $status) {?>
<!--LAPORAN NILAI PERSEDIAAN!! -->
<?php if ('laporan' == $id) { ?>
	<section class="content">

		<!-- Default box -->
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"><?php echo "$page"; ?></h3>

			</div>
			<div class="card-body">
				<form method="POST" class="form-inline" action="">
	<select name="bulan" class="form-control" required="required">


		<option value="1">Januari</option>
		<option value="2">Februari</option>
		<option value="3">Maret</option>
		<option value="4">April</option>
		<option value="5">Mei</option>
		<option value="6">Juni</option>
		<option value="7">Juli</option>
		<option value="8">Agustus</option>
		<option value="9">September</option>
		<option value="10">Oktober</option>
		<option value="11">November</option>
		<option value="12">Desember</option>
	</select>
	<select class="form-control" name="tahun">
		<?php
$mulai= date('Y') - 50;
for($i = $mulai;$i<$mulai + 100;$i++){
    $sel = $i == date('Y') ? ' selected="selected"' : '';
    echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';


}
?>

	</select>
	<button class="btn btn-primary" name="filter"><span class="glyphicon glyphicon-search"></span> Cari</button>
</form>
<br style="clear:both;"/><br />
<table id="example1" class="table table-bordered">
<thead>
				<tr>
					<th>No.</th>
					<th>Nama Barang</th>
					<th>Juml. beli</th>
					<th>Terjual</th>
					<th>Sisa barang</th>
					<th>Harga pokok per unit</th>
					<th>Nilai pers. akhir</th>
					<th>HPP</th>
					<th>Laba kotor</th>
				</tr>
			</thead>
			<tbody>
				<?php include 'filter.php'?>
			</tbody>
		</table>
			</div>

		</div>
		<!-- /.card -->
	</section>
<?php } ?>

<?php if ('omzet' == $id) { ?>
	<section class="content">

		<!-- Default box -->
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"><?php echo "$page"; ?></h3>

			</div>
			<div class="card-body">

			</div>

		</div>
		<!-- /.card -->
	</section>
<?php } ?>

<?php } ?>

<?php if ('Owner' == $status) {?>
<!-- AKUN !!!!!!!!!!!!!!!-->
	<?php if ('akun' == $id) { ?>
		<section class="content">
			<!-- Default box -->
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><?php echo "$page"; ?></h3>

					<div class="card-tools">
						<a href="index.php?id=tambahAkun"><button type="button" class="btn btn-block btn-primary">+ Tambah akun baru</button></a>

					</div>

				</div>
				<div class="card-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Email</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<?php

						$data = mysqli_query($connection, "SELECT * FROM akun ORDER BY IDAkun DESC");
						while ($a = mysqli_fetch_array($data)) {

						 ?>
						<tbody>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $a['nama']; ?></td>
							<td><?php echo $a['email']; ?></td>
							<td><?php echo $a['status']?></td>
							<td><a href="index.php?action=ubahAkun&id=<?php echo $a['IDAkun'];  ?>">Ubah</a> | <a href="index.php?action=hapusAkun&id=<?php echo $a['IDAkun'];  ?>">Hapus</a></td>
						</tr>
					<?php } ?>
				</tbody>

					</table>
				</div>


			</div>
			<!-- /.card -->

		</section>
	<?php } ?>


	<!-- TAMBAH AKUN !!!!!!!!!!!!!!!-->
		<?php if ('tambahAkun' == $id) { ?>
			<section class="content">

				<!-- Default box -->
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title"><?php echo "$page"; ?></h3>

					</div>
					<div class="card-body">

				<form class="form-horizontal" action="create.php" method="POST">
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
								<div class="col-sm-10">
									<input type="text" name="nama" class="form-control" id="inputEmail3" placeholder="Nama..." required>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
								<div class="col-sm-10">
									<input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email..." required>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
								<div class="col-sm-10">
									<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password..." required>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
								<div class="col-sm-10">

									<select class="form-control" name="status">
										<option>Karyawan</option>
										<option>Owner</option>

									</select>
								</div>
							</div>
							<input type="hidden" name="action" value="tambahakun">

					</div>

					<!-- /.card-body -->
					<div class="card-footer">
						<button type="submit" name="tambahAkun" class="btn btn-primary">Tambah</button>
						<a href="index.php?id=akun"<button type="submit" class="btn btn-default float-right">Batal</button></a>
					</div>

					</form>
					<!-- /.card-footer-->
				</div>
				<!-- /.card -->

			</section>
		<?php } ?>

<!--UBAH AKUN!! -->
<?php if ('ubahAkun' == $action) {
$IDAkun = $_REQUEST['id'];
$ubahAkun = "SELECT * FROM akun WHERE IDAkun='{$IDAkun}'";
$result = mysqli_query($connection, $ubahAkun);

$akun = mysqli_fetch_assoc($result);
	 ?>
	<section class="content">

		<!-- Default box -->
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title"><?php echo "$page"; ?></h3>

			</div>
			<div class="card-body">

				<form class="form-horizontal" action="create.php" method="POST">

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-10">
							<input type="text" name="nama" class="form-control" id="inputEmail3" value="<?php echo $akun['nama']; ?>" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-10">
							<input type="email" name="email" class="form-control" id="inputEmail3" value="<?php echo $akun['email']; ?>" required>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
						<div class="col-sm-10">

							<select class="form-control" name="status">
						<!--		<option>Karyawan</option>
								<option>Owner</option> -->
								<option value="Karyawan" <?php echo $akun['status'] == 'Karyawan' ? 'selected="selected"' : '' ?>>Karyawan</option>
   							<option value="Owner" <?php echo $akun['status'] == 'Owner' ? 'selected="selected"' : '' ?>>Owner</option>

							</select>
						</div>
					</div>
					<input type="hidden" name="action" value="ubahAkun">
					<input type="hidden" name="id" value="<?php echo $IDAkun; ?>">

			</div>

			<!-- /.card-body -->
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Simpan perubahan</button>
				<a href="index.php?id=akun"<button type="submit" class="btn btn-default float-right">Batal</button></a>
			</div>

			</form>
			<!-- /.card-footer-->
		</div>
		<!-- /.card -->

	</section>
<?php } ?>

<!-- HAPUS AKUN -->
		<?php if ( 'hapusAkun' == $action ) {
                        $IDAkun = $_REQUEST['id'];
                        $hapus = "DELETE FROM akun WHERE IDAkun ='{$IDAkun}'";
                        $result = mysqli_query( $connection, $hapus );
                        header( "location:index.php?id=akun" );
                }?>
<?php } ?>

<?php if ('profilKaryawan' == $id) {
$IDAkun = $ID;
$ubahAkun = "SELECT * FROM akun WHERE IDAkun='{$IDAkun}'";
$result = mysqli_query($connection, $ubahAkun);

$akun = mysqli_fetch_assoc($result);
	 ?>
	<section class="content">

		<!-- Default box -->
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title"><?php echo "$page"; ?></h3>

			</div>
			<div class="card-body">

				<form class="form-horizontal" action="create.php" method="POST">

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-10">
							<input type="text" name="nama" class="form-control" id="inputEmail3" value="<?php echo $akun['nama']; ?>" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-10">
							<input type="email" name="email" class="form-control" id="inputEmail3" value="<?php echo $akun['email']; ?>" required>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
						<div class="col-sm-10">
							<input type="email" name="status" class="form-control" id="inputEmail3" value="<?php echo $akun['status']; ?>" readonly>
						</div>
					</div>

					<div class="form-group row">
				 	 <label for="inputEmail3" class="col-sm-2 col-form-label">Password Lama</label>
				 	 <div class="col-sm-10">
				 		 <input type="password" name="passwordlama" class="form-control" id="inputEmail3" value="" required>
				 	 </div>
				  </div>

					<div class="form-group row">
				 	 <label for="inputEmail3" class="col-sm-2 col-form-label">Password Baru</label>
				 	 <div class="col-sm-10">
				 		 <input type="password" name="passwordbaru" class="form-control" id="inputEmail3" value="" required>
				 	 </div>
				  </div>


					<input type="hidden" name="action" value="profilKaryawan">
					<input type="hidden" name="id" value="<?php echo $IDAkun; ?>">

			</div>

			<!-- /.card-body -->
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Simpan perubahan</button>
				<a href="index.php?id=akun"<button type="submit" class="btn btn-default float-right">Batal</button></a>
			</div>

			</form>
			<!-- /.card-footer-->
		</div>
		<!-- /.card -->

	</section>
<?php } ?>

<?php if ('profilOwner' == $id) {
$IDAkun = $ID;
$ubahAkun = "SELECT * FROM akun WHERE IDAkun='{$IDAkun}'";
$result = mysqli_query($connection, $ubahAkun);

$akun = mysqli_fetch_assoc($result);
	 ?>
	<section class="content">

		<!-- Default box -->
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title"><?php echo "$page"; ?></h3>

			</div>
			<div class="card-body">

				<form class="form-horizontal" action="create.php" method="POST">

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-10">
							<input type="text" name="nama" class="form-control" id="inputEmail3" value="<?php echo $akun['nama']; ?>" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-10">
							<input type="email" name="email" class="form-control" id="inputEmail3" value="<?php echo $akun['email']; ?>" required>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
						<div class="col-sm-10">
							<input type="email" name="status" class="form-control" id="inputEmail3" value="<?php echo $akun['status']; ?>" readonly>
						</div>
					</div>

					<div class="form-group row">
				 	 <label for="inputEmail3" class="col-sm-2 col-form-label">Password Lama</label>
				 	 <div class="col-sm-10">
				 		 <input type="password" name="passwordlama" class="form-control" id="inputEmail3" value="" required>
				 	 </div>
				  </div>

					<div class="form-group row">
				 	 <label for="inputEmail3" class="col-sm-2 col-form-label">Password Baru</label>
				 	 <div class="col-sm-10">
				 		 <input type="password" name="passwordbaru" class="form-control" id="inputEmail3" value="" required>
				 	 </div>
				  </div>


					<input type="hidden" name="action" value="profilKaryawan">
					<input type="hidden" name="id" value="<?php echo $IDAkun; ?>">

			</div>

			<!-- /.card-body -->
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Simpan perubahan</button>
				<a href="index.php?id=akun"<button type="submit" class="btn btn-default float-right">Batal</button></a>
			</div>

			</form>
			<!-- /.card-footer-->
		</div>
		<!-- /.card -->

	</section>
<?php } ?>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0-rc
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="theme/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="theme/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="theme/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="theme/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="theme/dist/js/pages/dashboard3.js"></script>
<!-- DataTables  & Plugins -->
<script src="theme/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="theme/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="theme/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="theme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="theme/plugins/jszip/jszip.min.js"></script>
<script src="theme/plugins/pdfmake/pdfmake.min.js"></script>
<script src="theme/plugins/pdfmake/vfs_fonts.js"></script>
<script src="theme/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="theme/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="theme/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="theme/plugins/moment/moment.min.js"></script>
<script src="theme/plugins/inputmask/jquery.inputmask.min.js"></script>


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
function perkalian() {
		var txtFirstNumberValue = document.getElementById('jumlahbeli').value;
		var txtSecondNumberValue = document.getElementById('hargabeli').value;
		var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
		if (!isNaN(result)) {
			 document.getElementById('totalbeli').value = result;
		}
}

function penjualan() {
		var txt3NumberValue = document.getElementById('jumlahjual').value;
		var txt4NumberValue = document.getElementById('hargajual').value;
		var result = parseInt(txt3NumberValue) * parseInt(txt4NumberValue);
		if (!isNaN(result)) {
			 document.getElementById('totaljual').value = result;
		}
}
</script>

</body>
</html>
