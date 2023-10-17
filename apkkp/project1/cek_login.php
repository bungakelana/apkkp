<?php
include "config/koneksi.php";
$conn = mysqli_connect($servername, $username, $password, $database);
$user_login=$_POST['user_login'];
$enpass=md5($_POST['password']);
$sql=mysqli_query($conn,"select * from user where user_login='$user_login' and password='$enpass'");
$r=mysqli_fetch_array($sql);
if (!empty($r[id_user]))

{
    session_start();
    $_SESSION['sukses']=1;
    header('location:index.php');
}
else
{
    echo "gagal";
    exit;
}
?>