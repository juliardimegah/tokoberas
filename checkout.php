<?php
session_start();
$koneksi = new mysqli("localhost","root","","proyek");


//jk tidak ada session pelanggan(blm login,) .mk dilarikan ke login.php
if(!isset($_SESSION["pelanggan"])) 
{
	echo "<script>alert('silahkan login');</script>";
	echo "<script>location='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Checkout | Tokoberas</title>	
	<link rel="stylesheet" href="./css/bootstrap.css">
</head>
<body>
<!-- navbar -->
<nav class="navbar navbar-default">
	<div class="container">
			
		<ul class="nav navbar-nav">
			<li><a href="index.php">Home</a></li>
			<li><a href="keranjang.php">Keranjang</a></li>
			<!-- JK sudah login (ada session pelanggan) -->
		<?php if (isset($_SESSION["pelanggan"])): ?>
			<li><a href="logout.php">Logout</a></li>
		<!--selain itu (belom login||blm ada session pelanggan) -->
		<?php else: ?>
			<li><a href="login.php">Login</a></li>
		<?php endif ?>

			<li><a href="checkout.php">Checkout</a></li>
		</ul>
	</div>
</nav>



<section class="konten">
	<div class="container">
		<h1>Keranjang Belanja</h1>
		<hr>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Produk</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Subharga</th>
				</tr>
			</thead>
			<tbody>
				<?php $nomor=1; ?>
				<?php $totalbelanja = 0; ?>
				<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
					<!-- menampilkan produk yg sedang diperlukan berdasarkan id_produk -->
					<?php
					$ambil = $koneksi->query("SELECT * FROM produk
						WHERE id_produk='$id_produk'");
					$pecah = $ambil->fetch_assoc();
					$subharga = $pecah["harga_produk"]*$jumlah;
				
					?>
				<tr>
					<td><?php echo$nomor; ?></td>
					<td><?php echo $pecah["nama_produk"]; ?></td>
					<td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
					<td><?php echo $jumlah; ?></td>
					<td>Rp. <?php echo number_format($subharga); ?></td>
					
				</tr>
				<?php $nomor++; ?>
				<?php $totalbelanja+=$subharga; ?>
				<?php endforeach ?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="4">Total Belanja</th>
					<th>Rp. <?php echo number_format($totalbelanja) ?></th>
				</tr>
			</tfoot>
		</table>

		<p>Sebelum menekkan tombol checkoout, silahkan upload bukti transfer sesuai nominal diatas</p>

		<h2>Upload bukti transfer disini</h2>
		<form action="upload.php" method="post" enctype="multipart/form-data">
			<input type="file" name="file">
			<button type="submit" name="upload">Upload</button>
		</form>


		
		<form method="post">

            <button class="btn btn-primary" name="checkout">Checkout</button>
		</form>

		<?php 
        if  (isset($_POST["checkout"]))
        {
        	$id_pelanggan = $_SESSION["pelanggan"]["id"];
        	$tanggal_pembelian = date("Y-m-d");
			$total_belanja=$totalbelanja;


        	// 1. menyimpan data ke tabel pembelian
        	$koneksi->query("INSERT INTO pembelian (id, id_pelanggan, tanggal_pembelian, total_pembelian)
				VALUES ('','$id_pelanggan','$tanggal_pembelian','$total_belanja') ");
			echo "<script>alert('Pesanan anda sedang diproses');</script>";
			echo "<script>location='index.php';</script>";
	        // mengkosongkan keranjang belanja

            unset($_SESSION["keranjang"]);
        }

		?>

	</div>
</section>

</body>
</html>