<?php
set_error_handler(function(int $errno, string $errstr) {
    if ((strpos($errstr, 'Undefined array key') === false) && (strpos($errstr, 'Undefined variable') === false)) {
        return false;
    } else {
        return true;
    }
}, E_WARNING);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="./css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="./css/style.css">

    <title>Register | Tokoberas</title>
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
              <p class="mb-4">Silahkan isi form dibawah ini</p>
            </div>
            <form action="register.php" method="post">
              <div class="form-group first">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama">
                <br>
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username">
                <br>
              </div>
              <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" class="form-control" name="email">
                <br>
              </div>
              <div class="form-group">
                <label for="notelp">Nomor Telepon</label>
                <input type="text" class="form-control" name="notelp">
                <br>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
                <br>
              </div>
                
              <input type="submit" class="btn btn-block btn-success" name ="registrasi">
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>  
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>

<?php
  $koneksi = new mysqli("localhost","root","","proyek");

  if(!is_null($_POST["registrasi"]))
  {

	$nama = $_POST["nama"];
	$username = $_POST["username"];
  $password = $_POST["password"];
  $email = $_POST["email"];
  $notelp = $_POST["notelp"];


	$inputdata = $koneksi->query("INSERT INTO pelanggan(id, email_pelanggan, password_pelanggan, username, nama_pelanggan, telepon_pelanggan) 
                                VALUES ('','$email','$password','$username','$nama','$notelp')");
  if ($inputdata) {
    $koneksi -> close();

    echo "<script>alert('Data berhasil');</script>";
    echo "<script>location='login.php';</script>";
  }
  else {
    echo "<script>alert('Data tidak terinput');</script>";
    echo "<script>location='register.php';</script>";
    $koneksi -> close();
  }}
  ?>