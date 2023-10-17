<?php 
switch(@$_GET['act'])
{
     default:
        echo "
        <a href='index.php?menu=faktur_jual&act=tambah'>Tambah</a>
        <br>
        <table border=1>
        <tr><td> NO 
        <td> ID FAKTUR JUAL
        <td> NO FAKTUR JUAL
        <td> TGL FAKTUR
        <td> NAMA CUSTOMER
        <td> PPN";
        $no = 0;
        $tampil = mysqli_query($conn, "select * from faktur_jual join customer
        on faktur_jual.id_cust=customer.id_cust");
        while ($r = mysqli_fetch_array($tampil)) {
                $no = $no + 1;
                echo "<tr><td>$no
                <td>$r[id_fjual]
                <td>$r[no_fjual]
                <td>$r[tgl_fjual]
                <td>$r[nm_cust]
                <td>$r[ppn]
                <td><a href='?act=isi&id_fjual=$r[id_fjual]'>Isi</a>
                <td><a href='?act=edit&id_fjual=$r[id_fjual]'>Edit</a>
                <td><a href='master.php?act=hapus&id_fjual=$r[id_fjual]'>Hapus</a>";
        }
        echo "</table>";
        break;


    case "tambah":
        echo "<center>FORM INPUT FAKTUR JUAL
        <table border=1>
        <form action='master.php' method=POST>
        <input type=hidden name=act value=tambah>
        <tr><td>NO FAKTUR <td><input type=varchar name=no_fjual size=20 required>
        <tr><td>Tanggal<td><input type=date name=tgl_fjual required>
        <tr><td>ID Customer <td>
            <select name=id_cust required>
                <option value=>-Pilih Customer-</option>";
        $sql_faktur_jual = mysqli_query($conn, "select* from customer order by id_cust");
    
        while ($s = mysqli_fetch_array($sql_faktur_jual)) 
        {
            echo "<option value=$s[id_cust]>$s[nm_cust]";
        }
            echo "</select>

        <tr><td>PPN <td><input type=int name=ppn size=3 required>
        <tr><td><td><input type=submit name=proses value=SIMPAN>            

        </table>";
        break;

case "edit":
        $tampil = mysqli_query($conn, "select*from faktur_jual where id_fjual='$_GET[id_fjual]'");
        $r = mysqli_fetch_array($tampil);
        
        echo "<center>FORM EDIT FAKTUR PENJUALAN
        <table border=1>
        <form action='master.php' method=POST>

        <input type=hidden name=act value=edit>
        <input type=hidden name=id_fjual value='$_GET[id_fjual]'>
        <tr><td>NO Faktur       <td><input type=text name='no_fjual'        value='$r[no_fjual]' size=20 required>
        <tr><td>Tanggal         <td><input type=date    name='tgl_fjual'       value='$r[tgl_fjual]' required>

        <tr><td>NAMA CUSTOMER <td>
        <select name=id_cust required>
        <option value=>-Pilih Customer-</option>";
        $sql_faktur_jual = mysqli_query($conn, "select* from customer order by id_cust");
        while ($s1 = mysqli_fetch_array($sql_faktur_jual)) 
        {
                if ($s1[id_cust] == $r[id_cust]) 
                {
                        echo "<option value=$s1[id_cust]' selected>$s1[nm_cust]</option>";
                }
                else
                {
                        echo "<option value='$s1[id_cust]'>$s1[nm_cust]</option>";  
                }      
        }
        echo "</select>
        
        <tr><td>PPN<td> <input type=int name='ppn' value='$r[ppn]' size=3 required> 
        <tr><td><td><input type=submit name=proses value=UPDATE>
</table>";
        break;


case "isi":

        $id_fjual=$_GET[id_fjual];
        if (empty($id_fjual))
        {
           $id_fjual=$_POST[id_fjual];      
        }
        $tampil = mysqli_query($conn, "select * from faktur_jual join customer on faktur_jual.id_cust=customer.id_cust 
        where id_fjual='$id_fjual'");
        $r = mysqli_fetch_array($tampil);
                
        echo "<center>ISI FAKTUR PENJUALAN
        <table border=0>
        <form action='?menu=$menu&act=isi' method=POST>
        
        <input type=hidden name=act value=edit>
        <input type=hidden name=id_fjual value='$id_fjual'>
        <tr><td>NO Faktur Jual       <td> :$r[no_fjual] 
        <tr><td>Tanggal              <td> :$r[tgl_fjual] 
        <tr><td>Nama Customer        <td> :$r[nm_cust]       
        <tr><td>PPN                  <td> $r[ppn] 
        <tr><td>Enter Kode           <td><input type=text name='kd_brg'  value='$_POST[kd_brg]' size=20 required>
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
                <input type=hidden name='id_fjual' value='$id_fjual'>
                <input type=hidden name='tgl_fjual' value='$r[tgl_fjual]'>
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
      
        include "detail_jual.php";

break;

case "edit1":

        $id_fjual=$_GET[id_fjual];
        if (empty($id_fjual))
        {
           $id_fjual=$_POST[id_fjual];      
        }
        $tampil = mysqli_query($conn, "select * from faktur_jual join customer on faktur_jual.id_cust=customer.id_cust 
        where id_fjual='$id_fjual'");
        $r = mysqli_fetch_array($tampil);
                
        echo "<center>UBAH FAKTUR PENJUALAN
        <table border=0>
        <form action='?menu=$menu&act=isi' method=POST>
        
        <input type=hidden name=act value=edit>
        <input type=hidden name=id_fjual value='$id_fjual'>
        <tr><td>NO Faktur       <td> :$r[no_fjual] 
        <tr><td>Tanggal         <td> :$r[tgl_fjual] 
        <tr><td>Nama Customer   <td> :$r[nm_cust]       
        <tr><td>PPN             <td> : $r[ppn]"; 
        
         
        $tampil2 = mysqli_query($conn, "select * from detail_jual join barang join merek join kelompok
        on detail_jual.kd_brg=barang.kd_brg 
        and barang.kd_merek=merek.kd_merek 
        and barang.kd_kel=kelompok.kd_kel where id_jual='$_GET[id_jual]'");
        $r2 = mysqli_fetch_array($tampil2);

         
                echo 
                "</form><form action='master.php' method=POST>
                <input type=hidden name=act value=edit1>
                <input type=hidden name='id_fjual' value='$id_fjual'>
                <input type=hidden name='id_jual' value='$_GET[id_jual]'>
                <input type=hidden name='tgl_fjual' value='$r[tgl_fjual]'>
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
      
        include "detail_jual.php";

break;

}


?>