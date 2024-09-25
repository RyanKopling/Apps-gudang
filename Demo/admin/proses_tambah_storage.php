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