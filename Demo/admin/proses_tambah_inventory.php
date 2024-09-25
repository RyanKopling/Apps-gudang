<?php
if($_POST){
    $nama_barang = $_POST['nama_brg'];
    $jenis_barang = $_POST['jenis_brg'];
    $kuantitas_stok = $_POST['jml_stok'];
    $barcode = $_POST['barcode'];
    $id_vendor = $_POST['id_vendor'];
    $harga_barang = $_POST['harga'];
    $id_storage = $_POST['id_gudang'];
    if(empty($nama_barang)){
        echo "<script>alert('Nama Barang Tidak Boleh Kosong');location.href='tambah_inventory.php';</script>";
    } elseif(empty($jenis_barang)){
        echo "<script>alert('Jenis Barang Tidak Boleh Kosong');location.href='tambah_inventory.php';</script>";
    } elseif (empty($kuantitas_stok)){
        echo "<script>alert('Kuantitas Stok Tidak Boleh Kosong');location.href='tambah_inventory.php';</script>";
    } elseif (empty($barcode)){
        echo "<script>alert('Barcode Tidak Boleh Kosong');location.href='tambah_inventory.php';</script>";
    } elseif (empty($harga_barang)){
        echo "<script>alert('Harga Barang Tidak Boleh Kosong');location.href='tambah_inventory.php';</script>";
    }else {
        include "koneksi.php";
        $insert = mysqli_query($koneksi,"INSERT INTO inventory (nama_brg, jenis_brg, jml_stok , barcode, id_vendor, harga, id_gudang) value
        ('".$nama_barang."','".$jenis_barang."','".$kuantitas_stok."','".$barcode."','".$id_vendor."', '".$harga_barang."', '".$id_storage."')")
        or die(mysqli_error($koneksi));
        if($insert){
            echo "<script>alert('Sukses Menambahkan Barang Baru');location.href='index.php';</script>";
        } else {
            "<script>alert('Gagal Menambahkan Barang Baru');location.href='index.php';</script>";
        }
    }
}
?>