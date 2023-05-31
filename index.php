<?php 
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost","root","","proyek2");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home | Tokoberas</title>
	<link rel="stylesheet" href="./css/bootstrap.css">
	
	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
	<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

	<style>
		html, body {
			height: 100%;
			margin: 0;
		}
		.leaflet-container {
			height: 400px;
			width: 600px;
			max-width: 100%;
			max-height: 100%;
			margin-left: 500px;
		}

		.ftr{
			margin-top: 50px;
		}

		.loc{
			margin-left: 500px;
			margin-top: 30px;
			font-size: 30px;
			font-weight: 500;
			font-family: poppins;
		}
	</style>
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


<!-- konten -->
<section class="konten">
	<div class="container">
        <h1>Toko Beras</h1>

        <div class="row">
        	
<?php $ambil = $koneksi->query("SELECT * FROM produk "); ?>
<?php while($perproduk = $ambil->fetch_assoc()){ ?>
	
        	<div class="col-md-3">
        		<div class="thumbnail">
        			<img src="./images/foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="">
        			<div class="caption">
        				<h3><?php echo $perproduk['nama_produk']; ?></h3>
        				<h5>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h5>
        				<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Beli</a>
        			</div>
        		</div>
        	</div>
        <?php } ?>
	</div>
</section>

<div class="loc">
	Disini ya lokasi Kami!
</div>
<div id="map" style="width:600px; height: 400px;"></div>
<script>

	const map = L.map('map').setView([-6.8735951724556, 107.57567607116374], 17);

	const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);

	const marker = L.marker([-6.87345, 107.57595]).addTo(map);

	function onMapClick(e) {
		popup
			.setLatLng(e.latlng)
			.setContent(`You clicked the map at ${e.latlng.toString()}`)
			.openOn(map);
	}

	map.on('click', onMapClick);

</script>
<div class="ftr">
<footer class="bg-light text-center text-lg-start">
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2020 Copyright:
    <a class="text-dark" href="">Aulia dan Firda</a>
  </div>
  <!-- Copyright -->
</footer>
</div>
</body>
</html>