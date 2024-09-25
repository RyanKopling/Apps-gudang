<?php
$koneksi = mysqli_connect("localhost","root","","test");

if(!$koneksi){
    die ("koneksi gagal". mysqli_connect_error(). mysqli_connect_error());
}

?>