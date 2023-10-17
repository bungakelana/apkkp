<?php
switch(@$_GET['act'])
{
        default:
        echo "
        <a href='index.php?menu=kel&act=tambah'>Tambah</a>
        <br>
        <table border=1>
        <tr><td> NO 
        <td> KODE KELOMPOK 
        <td> NAMA KELOMPOK";
        $no=0;
        $tampil=mysqli_query($conn,"select*from kelompok");
        while($r=mysqli_fetch_array($tampil))
        {
        $no=$no+1;
        echo "<tr><td>$no
                        <td>$r[kd_kel]
                        <td>$r[nm_kel]
                        <td><a href='?act=edit&kd_kel=$r[kd_kel]'>Edit</a>
                        <td><a href='master.php?act=hapus&kd_kel=$r[kd_kel]'>Hapus</a>";
        } 
echo"</table>";
        break;

case"tambah":
        echo "<center>FORM INPUT KELOMPOK
        <table border=1>
        <form action='master.php' method=POST>
        <input type=hidden name=act value=tambah>
        
        <tr><td>Kode Kelompok <td><input type=text name=kd_kel size=4 required>
        <tr><td>Nama Kelompok<td><input type=text name=nm_kel size=20 required>
        
        <tr><td><td><input type=submit name=proses value=SIMPAN>
        
        </table>";
        break;

case "edit":
        $tampil=mysqli_query($conn,"select*from kelompok where kd_kel='$_GET[kd_kel]'");
        $r=mysqli_fetch_array($tampil);
        echo "<center>FORM EDIT DATA KELOMPOK
        <table border=1>
        <form action='master.php' method=POST>
        <input type=hidden name=act value=edit>
        <input type=hidden name=kd_kel value='$_GET[kd_kel]'>
                
        <tr><td>Kode Kelompok <td><input type=text name=kd_kel1 value='$r[kd_kel]' size=10 required>
        <tr><td>Nama Kelompok<td><input type=text name=nm_kel value='$r[nm_kel]' size=30 required>
                
        <tr><td><td><input type=submit name=proses value=UPDATE>
        </table>";
        break;
        
        
        
}
?>
