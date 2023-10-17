<?php
ini_set('display_errors',0);
session_start();
include "config/koneksi.php";
$conn = mysqli_connect($servername, $username, $password, $database);
$menu=$_SESSION['menu'];
if ($_SESSION['sukses']==0)
{
    include "login.php";
    exit;
}
echo "HALAMAN ADMIN
    <table border=1>
    <tr><td><a href='router.php'>Home</a>
        <td><a href='router.php?menu=user'>User</a>
        <td><a href='router.php?menu=merek'>Merek</a>
        <td><a href='router.php?menu=kel'>Kelompok</a>
        <td><a href='router.php?menu=brg'>Barang</a>
        <td><a href='router.php?menu=supplier'>Supplier</a>
        <td><a href='router.php?menu=faktur_beli'>Faktur Beli</a>
        <td><a href='router.php?menu=customer'>Customer</a>
        <td><a href='router.php?menu=faktur_jual'>Faktur Jual</a>
        <td><a href='router.php'>Logout</a>
    </table>";


if(empty($menu))
{ 
    include "modul/home.php";
}

if($menu=='user')
{ 
    include "modul/user.php";
}

if($menu=='merek')
{ 
    include "modul/merek.php";
}

if($menu=='kel')
{ 
    include "modul/kelompok.php";
}

if($menu=='brg')
{ 
    include "modul/barang.php";
}

if($menu=='supplier')
{ 
    include "modul/supplier.php";
}

if($menu=='faktur_beli')
{ 
    include "modul/faktur_beli.php";
}

if($menu=='detail_beli')
{ 
    include "modul/detail_beli.php";
}

if($menu=='customer')
{ 
    include "modul/customer.php";
}

if($menu=='faktur_jual')
{ 
    include "modul/faktur_jual.php";
}

if($menu=='detail_jual')
{ 
    include "modul/detail_jual.php";
}
?>