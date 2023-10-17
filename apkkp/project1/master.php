<?php
session_start();
$menu = $_SESSION['menu'];
$act = $_POST[act];
ob_start();
include "config/koneksi.php";
$conn = mysqli_connect($servername, $username, $password, $database);


//CRUD USER
if ($menu == 'user' and $act == 'tambah') {
    $enpass = md5($_POST[password]);
    mysqli_query($conn, "insert into user(user_login,password,nama,level)
    values('$_POST[user_login]','$enpass','$_POST[nama]','$_POST[level]')");
    header("location:index.php");
}

if ($menu == 'user' and $act == 'edit') {
    $enpass = md5($_POST[password]);
    mysqli_query($conn, "update user set user_login='$_POST[user_login]',
                                    password='$enpas',
                                    nama='$_POST[nama]',
                                    level='$_POST[level]'
                                where id_user='$_POST[id_user]'");
    header("location:index.php");
}

if ($menu == 'user' and $_GET[act] == 'hapus') {
    mysqli_query($conn, "delete from user where id_user='$_GET[id_user]'");
    header("location:index.php");
}


//CRUD MEREK
if ($menu == 'merek' and $act == 'tambah') {
    mysqli_query($conn, "insert into merek(kd_merek, nm_merek)
    values('$_POST[kd_merek]','$_POST[nm_merek]')");
    header("location:index.php");
}

if ($menu == 'merek' and $act == 'edit') {
    mysqli_query($conn, "update merek set kd_merek='$_POST[kd_merek1]',
                                        nm_merek='$_POST[nm_merek]'
                                        where kd_merek='$_POST[kd_merek]'");

    header("location:index.php");
}

if ($menu == 'merek' and $_GET[act] == 'hapus') {
    mysqli_query($conn, "delete from merek where kd_merek='$_GET[kd_merek]'");
    header("location:index.php");
}



//CRUD KELOMPOK BARANG
if ($menu == 'kel' and $act == 'tambah') {
    mysqli_query($conn, "insert into kelompok(kd_kel, nm_kel)
    values('$_POST[kd_kel]','$_POST[nm_kel]')");
    header("location:index.php");
}

if ($menu == 'kel' and $act == 'edit') {
    mysqli_query($conn, "update kelompok set kd_kel='$_POST[kd_kel1]',
                                        nm_kel='$_POST[nm_kel]'
                                        where kd_kel='$_POST[kd_kel]'");

    header("location:index.php");
}

if ($menu == 'kel' and $_GET[act] == 'hapus') {
    mysqli_query($conn, "delete from kelompok where kd_kel='$_GET[kd_kel]'");
    header("location:index.php");
}


//CRUD BARANG
if ($menu == 'brg' and $act == 'tambah') {
    mysqli_query($conn, "insert into barang(kd_brg, nm_brg, kd_merek, kd_kel, hrg_beli, hrg_jual, stock)
    values('$_POST[kd_brg]',
            '$_POST[nm_brg]',
            '$_POST[kd_merek]',
            '$_POST[kd_kel]',
            '$_POST[hrg_beli]',
            '$_POST[hrg_jual]',
            '$_POST[stock]')");
    header("location:index.php");
}

if ($menu == 'brg' and $act == 'edit') {
    mysqli_query($conn, "update barang set kd_brg='$_POST[kd_brg1]',
                                        nm_brg='$_POST[nm_brg]',
                                        kd_merek='$_POST[kd_merek]',
                                        kd_kel='$_POST[kd_kel]',
                                        hrg_beli='$_POST[hrg_beli]',
                                        hrg_jual='$_POST[hrg_jual]',
                                        stock='$_POST[stock]'            
                                        where kd_brg='$_POST[kd_brg]'");
    header("location:index.php");
}

if ($menu == 'brg' and $_GET[act] == 'hapus') {
    mysqli_query($conn, "delete from barang where kd_brg='$_GET[kd_brg]'");
    header("location:index.php");
}


//CRUD SUPPLIER
if ($menu == 'supplier' and $act == 'tambah') {
    mysqli_query($conn, "insert into supplier(id_sup, nm_sup, alamat, kota, no_hp)
    values('$_POST[id_sup]',
            '$_POST[nm_sup]',
            '$_POST[alamat]',
            '$_POST[kota]',
            '$_POST[no_hp]')");
    header("location:index.php");
}

if ($menu == 'supplier' and $act == 'edit') 
{
    mysqli_query($conn, "update supplier set id_sup='$_POST[id_sup1]',
                                        nm_sup='$_POST[nm_sup]',
                                        alamat='$_POST[alamat]',
                                        kota='$_POST[kota]',
                                        no_hp='$_POST[no_hp]'
                                        where id_sup='$_POST[id_sup]'");
    header("location:index.php");
}

if ($menu == 'supplier' and $_GET[act] == 'hapus') {
    mysqli_query($conn, "delete from supplier where id_sup='$_GET[id_sup]'");
    header("location:index.php");
}


//CRUD FAKTUR PEMBELIAN
if ($menu == 'faktur_beli' and $act == 'tambah') 
{
    mysqli_query($conn, "insert into faktur_beli(no_faktur, tgl_faktur, id_sup, ppn)
    values(
            '$_POST[no_faktur]',
            '$_POST[tgl_faktur]',
            '$_POST[id_sup]',
            '$_POST[ppn]')");
    header("location:index.php");
}


if ($menu == 'faktur_beli' and $act == 'edit') 
{
    mysqli_query($conn, "update faktur_beli set no_faktur   ='$_POST[no_faktur]',
                                                tgl_faktur  ='$_POST[tgl_faktur]',
                                                id_sup      ='$_POST[id_sup]',
                                                ppn         ='$_POST[ppn]'
                                                where id_faktur='$_POST[id_faktur]'");
    header("location:index.php");
}

if ($menu == 'faktur_beli' and $_GET[act] == 'hapus') 
{
    mysqli_query($conn, "delete from faktur_beli where id_faktur='$_GET[id_faktur]'");
    header("location:index.php");
}

if ($menu == 'faktur_beli' and $act == 'simpan') 
{
    mysqli_query($conn, "insert into faktur_beli(nm_brg, nm_merek, nm_kel, jumlah, harga)
    values(
            '$_POST[nm_brg]',
            '$_POST[nm_merek]',
            '$_POST[nm_kel]',
            '$_POST[jumlah]',
            '$_POST[harga]')");
    header("location:index.php");
}

if ($menu == 'faktur_beli' and $act == 'isi') 
{
    mysqli_query($conn, "insert into detail_beli(id_faktur,tgl_faktur,kd_brg,jumlah, harga)
    values(
            '$_POST[id_faktur]',
            '$_POST[tgl_faktur]',
            '$_POST[kd_brg]',
            '$_POST[jumlah]',
            '$_POST[harga]')");

    header("location:index.php?act=isi&id_faktur=$_POST[id_faktur]");
}


//CRUD ISI DETAIL PEMBELIAN
if ($menu == 'detail_beli' and $act == 'edit') 
{
    mysqli_query($conn, "update detail_beli set id_faktur   ='$_POST[id_faktur1]',
                                                tgl_faktur  ='$_POST[tgl_faktur]',
                                                kd_brg      ='$_POST[kd_brg]',
                                                jumlah      ='$_POST[jumlah]',
                                                harga       ='$_POST[harga]')");
    header("location:index.php");   
}

if ($menu == 'faktur_beli' and $_GET[act] == 'hapus1') 
{
    mysqli_query($conn, "delete from detail_beli where id_beli='$_GET[id_beli]'");
    header("location:index.php?act=isi&id_faktur=$_GET[id_faktur]");
}


if ($menu == 'faktur_beli' and $_POST[act] == 'edit1') 
{
     mysqli_query($conn, "update detail_beli set jumlah     ='$_POST[jumlah]',
                                                harga      ='$_POST[harga]'
                                                where id_beli='$_POST[id_beli]'");
    header("location:index.php?act=isi&id_faktur=$_POST[id_faktur]");
}


//CRUD CUSTOMER
if ($menu == 'customer' and $act == 'tambah') {
    mysqli_query($conn, "insert into customer(id_cust, nm_cust, alamat, kota, no_hp)
    values('$_POST[id_cust]',
            '$_POST[nm_cust]',
            '$_POST[alamat]',
            '$_POST[kota]',
            '$_POST[no_hp]')");
    header("location:index.php");
}

if ($menu == 'customer' and $act == 'edit') 
{
    mysqli_query($conn, "update customer set id_cust='$_POST[id_cust1]',
                                        nm_cust='$_POST[nm_cust]',
                                        alamat='$_POST[alamat]',
                                        kota='$_POST[kota]',
                                        no_hp='$_POST[no_hp]'
                                        where id_cust='$_POST[id_cust]'");
    header("location:index.php");
}

if ($menu == 'customer' and $_GET[act] == 'hapus') {
    mysqli_query($conn, "delete from customer where id_cust='$_GET[id_cust]'");
    header("location:index.php");
}



//CRUD FAKTUR JUAL
if ($menu == 'faktur_jual' and $act == 'tambah') 
{
    mysqli_query($conn, "insert into faktur_jual(no_fjual, tgl_fjual, id_cust, ppn)
    values(
            '$_POST[no_fjual]',
            '$_POST[tgl_fjual]',
            '$_POST[id_cust]',
            '$_POST[ppn]')");
    header("location:index.php");
}


if ($menu == 'faktur_jual' and $act == 'edit') 
{
    
    mysqli_query($conn, "update faktur_jual set no_fjual    ='$_POST[no_fjual]',
                                                tgl_fjual   ='$_POST[tgl_fjual]',
                                                ppn         ='$_POST[ppn]',
                                                id_cust     ='$_POST[id_cust]'
                                                where id_fjual='$_POST[id_fjual]'");
    header("location:index.php");
}

if ($menu == 'faktur_jual' and $_GET[act] == 'hapus') 
{
    mysqli_query($conn, "delete from faktur_jual where id_fjual='$_GET[id_fjual]'");
    header("location:index.php");
}

if ($menu == 'faktur_jual' and $act == 'simpan') 
{
    
    mysqli_query($conn, "insert into faktur_jual(nm_brg, nm_merek, nm_kel, jumlah, hrg_jual)
    values(
            '$_POST[nm_brg]',
            '$_POST[nm_merek]',
            '$_POST[nm_kel]',
            '$_POST[jumlah]',
            '$_POST[hrg_jual]')");
    header("location:index.php");
}

if ($menu == 'faktur_jual' and $act == 'isi') 
{
    
    mysqli_query($conn, "insert into detail_jual(id_fjual,tgl_fjual,kd_brg,jumlah, harga)
    values(
            '$_POST[id_fjual]',
            '$_POST[tgl_fjual]',
            '$_POST[kd_brg]',
            '$_POST[jumlah]',
            '$_POST[harga]')");

    header("location:index.php?act=isi&id_fjual=$_POST[id_fjual]");
}

//CRUD ISI DETAIL PENJUALAN
if ($menu == 'detail_jual' and $act == 'edit') 
{
    mysqli_query($conn, "update detail_jual set id_fjual   ='$_POST[id_fjual1]',
                                                tgl_fjual  ='$_POST[tgl_fjual]',
                                                kd_brg     ='$_POST[kd_brg]',
                                                jumlah     ='$_POST[jumlah]',
                                                harga      ='$_POST[harga]')");
    header("location:index.php");   
}

if ($menu == 'faktur_jual' and $_GET[act] == 'hapus1') 
{
    mysqli_query($conn, "delete from detail_jual where id_jual='$_GET[id_jual]'");
    header("location:index.php?act=isi&id_fjual=$_GET[id_fjual]");
}


if ($menu == 'faktur_jual' and $_POST[act] == 'edit1') 
{
     mysqli_query($conn, "update detail_jual set jumlah         ='$_POST[jumlah]',
                                                harga           ='$_POST[harga]'
                                                where id_jual   ='$_POST[id_jual]'");
    header("location:index.php?act=isi&id_fjual=$_POST[id_fjual]");
}


?>