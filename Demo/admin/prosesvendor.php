<?php
if($_POST){
    $nama = $_POST['nama_vendor'];
    $kontak = $_POST['kontak'];
    $nama_barang = $_POST['nama_brgg'];
    
    if(empty($nama)){
        echo "<script>alert('Nomor Invoice tidak boleh kosong');location.href='tambah_vendor.php';</script>";
    } elseif (empty($kontak)){
        echo "<script>alert('Nama Vendor tidak boleh kosong');location.href='tambah_vendor.php';</script>";
    } elseif (empty($nama_barang)){
        echo "<script>alert('Kontak Vendor tidak boleh kosong');location.href='tambah_vendor.php';</script>";
    }else {
        include "koneksi.php";
        $insert = mysqli_query ($koneksi, "INSERT INTO vendor ( nama_vendor, kontak, nama_brgg) VALUE ('".$nama."','".$kontak."','".$nama_barang."')")
        or die(mysqli_error($koneksi));
        if($insert){
            echo "<script>alert('Sukses Menambahkan Vendor Baru');location.href='index.php';</script>";
        } else {
            "<script>alert('Gagal Menambahkan Vendor Baru');location.href='index.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Vendor / Supplier Baru</title>
    <link href="../aset/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Tambah Vendor / Supplier Baru</h2>
        <form action="prosesvendor.php" method="post">
            <div class="mb-3">
                <label for="nama_vendor" class="form-label">Nama Vendor:</label>
                <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" value="">
            </div>
            <div class="mb-3">
                <label for="kontak" class="form-label">Kontak:</label>
                <input type="text" class="form-control" id="kontak" name="kontak" value="">
            </div>
            <div class="mb-3">
                <label for="nama_brgg" class="form-label">Nama Barang:</label>
                <input type="text" class="form-control" id="nama_brgg" name="nama_brgg" value="">
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Tambah</button>
            <a class="btn btn-sm btn-danger" href="index.php">Cancel</a>
        </form>
    </div>
    <script src="../aset/bootstrap.bundle.min.js"></script>
</body>
</html>
