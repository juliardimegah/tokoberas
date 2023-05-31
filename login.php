<?php
session_start();
$koneksi = new mysqli("localhost","root","","proyek");

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Login | Tokoberas</title>
  </head>
  <body>
  

  
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="./images/fotologin2.jpeg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Selamat Datang</h3>
              <p class="mb-4">Silahkan Login untuk melanjutkan</p>
            </div>
            <form action="#" method="post">
              <div class="form-group first">
                <label for="username">username</label>
                <input type="username" class="form-control" name="username">

              </div>
              <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
              </div>
                  <input type="submit" value="Log In" class="btn btn-block btn-success" name ="login">
                  <br>
                  <p>Belum punya akun?</p>
                  
                  <a href="./register.php"><b>Daftar disini.</b></a>
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

<?php
  if(isset($_POST["login"]))
{

	$username = $_POST["username"];
	$password = $_POST["password"];
	//lakukan query ngecek akun di tabel pelanggan di db
	$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE username='$username' 
		AND password_pelanggan='$password'");

	//ngitung akun yang terambil
	$akunyangcocok = $ambil->num_rows;

	//jika 1 akun yg cocok, maka diloginkan
	if ($akunyangcocok==1)
	{
		//anda sukses login
		//mendapatkan akun dlm bentuk array
		$akun = $ambil->fetch_assoc();
		// simpan di session pelanggan
		$_SESSION["pelanggan"] = $akun;
		echo "<script>alert('anda sukses login');</script>";
		echo "<script>location='index.php';</script>";
	}
	else
	{
		//anda gagal login
		echo "<script>alert('anda gagal login, periksa akun anda');</script>";
		echo "<script>location='login.php';</script>";
	}
}
?>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>