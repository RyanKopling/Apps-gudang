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