<?php
if($_POST){
    $nama_gudang = $_POST['nama_gudang'];
    $lokasi_gudang = $_POST['lokasi_gudang'];
    
    if(empty($nama_gudang)){
        echo "<script>alert('Nama Gudang Tidak Boleh Kosong');location.href='tambah_storage.php';</script>";
    } elseif (empty($lokasi_gudang)){
        echo "<script>alert('Lokasi Gudang Tidak Boleh Kosong');location.href='tambah_storage.php';</script>";
    } else {
        include "koneksi.php";
        $insert = mysqli_query ($koneksi, "INSERT INTO storage (nama_gudang, lokasi_gudang) VALUE ('".$nama_gudang."','".$lokasi_gudang."')")
        or die(mysqli_error($koneksi));
        if($insert){
            echo "<script>alert('Sukses menambahkan gudang baru');location.href='index.php';</script>";
        } else {
            "<script>alert('Gagal menambahkan gudang baru');location.href='index.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Gudang Baru</title>
    <link href="../aset/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Tambah Gudang Baru</h2>
        <form action="proses_storage.php" method="post">
            <div class="mb-3">
                <label for="nama_gudang" class="form-label">Nama Gudang:</label>
                <input type="text" class="form-control" id="nama_gudang" name="nama_gudang" value="">
            </div>
            <div class="mb-3">
                <label for="lokasi_gudang" class="form-label">Lokasi Gudang:</label>
                <input type="text" class="form-control" id="lokasi_gudang" name="lokasi_gudang" value="">
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Tambah</button>
            <a class="btn btn-sm btn-danger" href="index.php">Cancel</a>
        </form>
    </div>
    <script src="../aset/bootstrap.bundle.min.js"></script>
</body>
</html>