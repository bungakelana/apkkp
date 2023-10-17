<?php
switch(@$_GET['act'])
{
        default:
        echo "
        <a href='index.php?menu=user&act=tambah'>Tambah</a>
        <br>
        <table border=1>
        <tr>
        <td> NO 
        <td> USER LOGIN 
        <td> NAMA 
        <td> LEVEL 
        <td> EDIT 
        <td> HAPUS";
        $no=0;
        $tampil=mysqli_query($conn,"select * from user");
        while($r=mysqli_fetch_array($tampil))
        {
            $no=$no+1;
            echo "
            <tr>
            <td>$no
                <td>$r[user_login]
                <td>$r[nama]
                <td>$r[level]
                <td><a href='?act=edit&id_user=$r[id_user]'>edit</a>
                <td><a href='master.php?act=hapus&id_user=$r[id_user]'>hapus</a>";
        } 
echo"</table>";
        break;

case"tambah":
echo "<center>FORM INPUT DATA USER
    <table border=1>
    <form action='master.php' method=POST>
    <input type=hidden name=act value=tambah>

    <tr><td>User Login <td><input type=text name=user_login size=20
    required>

    <tr><td>Password    <td><input type=text name=password size=20
    required>

    <tr><td>Nama  <td><input type=text name=nama size=20
    required>

    <tr><td>Level       <td><select name=level required>
                        <option value=>---PILIH---
                        <option value=Admin>Admin
                        <option value=Kasir>Kasir
                        <option value=Acc>Acc
                        </select>
    <tr><td><td><input type=submit name=proses value=SIMPAN>
    </table>";
    break;

case"edit":
        $tampil=mysqli_query($conn,"select*from user where id_user='$_GET[id_user]'");
        $r=mysqli_fetch_array($tampil);

        echo "<center>FORM EDIT DATA USER
        <table border=1>
        <form action='master.php' method=POST>
        <input type=hidden name=act value=edit>
        <input type=hidden name=id_user value=$_GET[id_user]>
      
        <tr><td>User Login <td><input type=text name=user_login value='$r[user_login]' size=20 required>
        <tr><td>Password    <td><input type=text name=password size=20 required>
        <tr><td>Nama        <td><input type=text name=nama value='$r[nama]'size=20 required>  

        <tr><td>Level       <td><select name=level required>
                             <option value='$r[level]' selected>$r[level]
                              <option value=Admin>Admin
                                <option value=Kasir>Kasir
                                <option value=Acc>Acc
                                </select>

        <tr><td><td><input type=submit name=proses value=UPDATE>
        </table>";
            break;
}
?>
