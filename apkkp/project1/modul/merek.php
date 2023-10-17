<?php
switch(@$_GET['act'])
{
        default:
        echo "
        <a href='index.php?menu=merek&act=tambah'>Tambah</a>
        <br>
        <table border=1>
        <tr><td> NO <td> KODE MEREK <td> NAMA MEREK";
        $no=0;
        $tampil=mysqli_query($conn,"select*from merek");
        while($r=mysqli_fetch_array($tampil))
        {
            $no=$no+1;
            echo "<tr><td>$no
                        <td>$r[kd_merek]
                        <td>$r[nm_merek]
                        <td><a href='?act=edit&kd_merek=$r[kd_merek]'>Edit</a>
                        <td><a href='master.php?act=hapus&kd_merek=$r[kd_merek]'>Hapus</a>";
        } 
echo"</table>";
        break;

case"tambah":
echo "<center>FORM INPUT MEREK
    <table border=1>
    <form action='master.php' method=POST>
    <input type=hidden name=act value=tambah>

    <tr><td>Kode Merek <td><input type=text name=kd_merek size=10 required>
    <tr><td>Nama Merek<td><input type=text name=nm_merek size=30 required>

    <tr><td><td><input type=submit name=proses value=SIMPAN>

    </table>";
    break;

case "edit":
        $tampil=mysqli_query($conn,"select*from merek where kd_merek='$_GET[kd_merek]'");
        $r=mysqli_fetch_array($tampil);
        echo "<center>FORM EDIT DATA MEREK
        <table border=1>
        <form action='master.php' method=POST>
        <input type=hidden name=act value=edit>
        <input type=hidden name=kd_merek value='$_GET[kd_merek]'>
        
        <tr><td>Kode Merek <td><input type=text name=kd_merek1 value='$r[kd_merek]' size=10 required>
        <tr><td>Nama Merek<td><input type=text name=nm_merek value='$r[nm_merek]' size=30 required>
        
            <tr><td><td><input type=submit name=proses value=UPDATE>
            </table>";
            break;


}
?>
