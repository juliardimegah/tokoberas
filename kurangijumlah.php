<?php 
session_start();
// mendapatkan id_produk dari url
$id_produk = $_GET['id'];


// jk sudah ada produk itu dikeranjang, maka produk itu jumlahnya di +1
if(isset($_SESSION['keranjang'][$id_produk]))
{
$_SESSION['keranjang'][$id_produk]-=1;
}

echo "<script>alert('jumlah produk diperbarui');</script>";
echo "<script>location='keranjang.php'</script>";
?>