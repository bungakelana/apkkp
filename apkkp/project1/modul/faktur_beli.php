<?php
switch(@$_GET['act'])
{
        default:
        echo "
        <a href='index.php?menu=faktur_beli&act=tambah'>Tambah</a>
        <br>
        <table border=1>
        <tr><td> NO 
        <td> ID FAKTUR
        <td> NO FAKTUR
        <td> TGL FAKTUR
        <td> NAMA SUPPLIER
        <td> PPN";
        $no = 0;
        $tampil = mysqli_query($conn, "select * from faktur_beli join supplier 
        on faktur_beli.id_sup=supplier.id_sup");
        while ($r = mysqli_fetch_array($tampil)) {
                $no = $no + 1;
                echo "<tr><td>$no
                <td>$r[id_faktur]
                <td>$r[no_faktur]
                <td>$r[tgl_faktur]
                <td>$r[nm_sup]
                <td>$r[ppn]
                <td><a href='?act=isi&id_faktur=$r[id_faktur]'>Isi</a>
                <td><a href='?act=edit&id_faktur=$r[id_faktur]'>Edit</a>
                <td><a href='master.php?act=hapus&id_faktur=$r[id_faktur]'>Hapus</a>";
        }
        echo "</table>";
        break;

case "tambah":
        echo "<center>FORM INPUT FAKTUR PEMBELIAN
<table border=1>
<form action='master.php' method=POST>
<input type=hidden name=act value=tambah>
<tr><td>NO FAKTUR <td><input type=varchar name=no_faktur size=20 required>

<tr><td>Tanggal<td><input type=date name=tgl_faktur required>

<tr><td>ID Supplier <td>
<select name=id_sup required>
        <option value=>-Pilih Supplier-</option>";
        $sql_faktur_beli = mysqli_query($conn, "select* from supplier order by id_sup");
        while ($s = mysqli_fetch_array($sql_faktur_beli)) 
        {
                echo "<option value=$s[id_sup]>$s[nm_sup]";
        }
        echo "</select>

<tr><td>PPN <td><input type=int name=ppn size=3 required>
<tr><td><td><input type=submit name=proses value=SIMPAN>            
</table>";
        break;

case "edit":
        $tampil = mysqli_query($conn, "select*from faktur_beli where id_faktur='$_GET[id_faktur]'");
        $r = mysqli_fetch_array($tampil);
        
        echo "<center>FORM EDIT FAKTUR PEMBELIAN
        <table border=1>
        <form action='master.php' method=POST>

        <input type=hidden name=act value=edit>
        <input type=hidden name=id_faktur value='$_GET[id_faktur]'>
        <tr><td>NO Faktur       <td><input type=varchar name='no_faktur'        value='$r[no_faktur]' size=20 required>
        <tr><td>Tanggal         <td><input type=date    name='tgl_faktur'       value='$r[tgl_faktur]' required>

        <tr><td>NAMA SUPPLIER <td>
        <select name=id_sup required>
        <option value=>-Pilih Supplier-</option>";
        $sql_faktur_beli = mysqli_query($conn, "select* from supplier order by id_sup");
        while ($s1 = mysqli_fetch_array($sql_faktur_beli)) 
        {
                if ($s1[id_sup] == $r[id_sup]) 
                {
                        echo "<option value=$s1[id_sup]' selected>$s1[nm_sup]</option>";
                }
                else
                {
                        echo "<option value='$s1[id_sup]'>$s1[nm_sup]</option>";  
                }      
        }
        echo "</select>
        
        <tr><td>PPN<td> <input type=int name='ppn' value='$r[ppn]' size=3 required> 
        <tr><td><td><input type=submit name=proses value=UPDATE>
</table>";
        break;


case "isi":

        $id_faktur=$_GET[id_faktur];
        if (empty($id_faktur))
        {
           $id_faktur=$_POST[id_faktur];      
        }
        $tampil = mysqli_query($conn, "select * from faktur_beli join supplier on faktur_beli.id_sup=supplier.id_sup 
        where id_faktur='$id_faktur'");
        $r = mysqli_fetch_array($tampil);
                
        echo "<center>ISI FAKTUR PEMBELIAN
        <table border=0>
        <form action='?menu=$menu&act=isi' method=POST>
        
        <input type=hidden name=act value=edit>
        <input type=hidden name=id_faktur value='$id_faktur'>
        <tr><td>NO Faktur       <td> :$r[no_faktur] 
        <tr><td>Tanggal         <td> :$r[tgl_faktur] 
        <tr><td>Nama Supplier   <td> :$r[nm_sup]       
        <tr><td>PPN <td> $r[ppn] 
        
        <tr><td>Enter Kode       <td><input type=text name='kd_brg'  value='$_POST[kd_brg]' size=20 required>
        <tr><td><td><input type=submit name=proses value=PROSES>";

        $tampil2 = mysqli_query($conn, "select * from barang join merek join kelompok
        on barang.kd_merek=merek.kd_merek and barang.kd_kel=kelompok.kd_kel where kd_brg='$_POST[kd_brg]'");
        $r2 = mysqli_fetch_array($tampil2);

        if (empty($r2[kd_brg]))
        {
                if (!empty($_POST[kd_brg]))
        {
                echo "kode tidak ada";
        }
             
        }
        else
        {
                echo 
                "</form><form action='master.php' method=POST>
                <input type=hidden name=act value=isi>
                <input type=hidden name='id_faktur' value='$id_faktur'>
                <input type=hidden name='tgl_faktur' value='$r[tgl_faktur]'>
                <input type=hidden name='kd_brg' value='$_POST[kd_brg]'>";

                echo 
                "
                <tr><td> Nama Barang   <td> : $r2[nm_brg] 
                <tr><td> Merek         <td> : $r2[nm_merek]
                <tr><td> Kelompok      <td> : $r2[nm_kel]

                <tr><td> Jumlah        <td><input type=number name='jumlah' value='$_POST[jumlah]' size=20 required>
                <tr><td> Harga         <td><input type=number name='harga' value='$r2[harga]' size=20 required>";       
        }
        echo "
   
        <tr><td><td><input type=submit name=proses value=SIMPAN>
        </table>";
      
        include "detail_beli.php";

break;

case "edit1":

        $id_faktur=$_GET[id_faktur];
        if (empty($id_faktur))
        {
           $id_faktur=$_POST[id_faktur];      
        }
        $tampil = mysqli_query($conn, "select * from faktur_beli join supplier on faktur_beli.id_sup=supplier.id_sup 
        where id_faktur='$id_faktur'");
        $r = mysqli_fetch_array($tampil);
                
        echo "<center>UBAH FAKTUR PEMBELIAN
        <table border=0>
        <form action='?menu=$menu&act=isi' method=POST>
        
        <input type=hidden name=act value=edit>
        <input type=hidden name=id_faktur value='$id_faktur'>
        <tr><td>NO Faktur       <td> :$r[no_faktur] 
        <tr><td>Tanggal         <td> :$r[tgl_faktur] 
        <tr><td>Nama Supplier   <td> :$r[nm_sup]       
        <tr><td>PPN <td>: $r[ppn]"; 
        
         
        $tampil2 = mysqli_query($conn, "select * from detail_beli join barang join merek join kelompok
        on detail_beli.kd_brg=barang.kd_brg 
        and barang.kd_merek=merek.kd_merek 
        and barang.kd_kel=kelompok.kd_kel where id_beli='$_GET[id_beli]'");
        $r2 = mysqli_fetch_array($tampil2);

         
                echo 
                "</form><form action='master.php' method=POST>
                <input type=hidden name=act value=edit1>
                <input type=hidden name='id_faktur' value='$id_faktur'>
                <input type=hidden name='id_beli' value='$_GET[id_beli]'>
                <input type=hidden name='tgl_faktur' value='$r[tgl_faktur]'>
                <input type=hidden name='kd_brg' value='$_POST[kd_brg]'>";

                echo 
                "
                <tr><td> Nama Barang   <td> : $r2[nm_brg] 
                <tr><td> Merek         <td> : $r2[nm_merek]
                <tr><td> Kelompok      <td> : $r2[nm_kel]

                <tr><td> Jumlah        <td><input type=number name='jumlah' value='$r2[jumlah]' size=20 required>
                <tr><td> Harga         <td><input type=number name='harga' value='$r2[harga]' size=20 required>";       
        
        echo "
   
        <tr><td><td><input type=submit name=proses value=UPDATE>
        </table>";
      
        include "detail_beli.php";

break;

}
?>
