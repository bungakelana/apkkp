<?php
switch (@$_GET['act']) {
        default:
                echo "<a href='index.php?menu=brg&act=tambah'>Tambah</a>
        <br>
        <table border=1>
        <tr><td> NO 
                <td> KODE BARANG 
                <td> NAMA BARANG 
                <td> NAMA MEREK 
                <td> NAMA KELOMPOK 
                <td> HARGA BELI
                <td> HARGA JUAL 
                <td> STOCK";
                $no = 0;
                $tampil = mysqli_query($conn, "select * from barang join merek join kelompok
                on barang.kd_merek=merek.kd_merek and barang.kd_kel=kelompok.kd_kel");
                while ($r = mysqli_fetch_array($tampil)) {
                        $no = $no + 1;
                        echo "<tr><td>$no
                        <td>$r[kd_brg]
                        <td>$r[nm_brg]
                        <td>$r[nm_merek]
                        <td>$r[nm_kel]
                        <td>$r[hrg_beli]
                        <td>$r[hrg_jual]
                        <td>$r[stock]
                        <td><a href='?act=edit&kd_brg=$r[kd_brg]'>Edit</a>
                        <td><a href='master.php?act=hapus&kd_brg=$r[kd_brg]'>Hapus</a>";
                }
                echo "</table>";
                break;

        case "tambah":
                echo "<center>FORM INPUT BARANG
        <table border=1>
        <form action='master.php' method=POST>
        <input type=hidden name=act value=tambah>
        
        <tr><td>Kode Barang <td><input type=text name=kd_brg size=10 required>
        <tr><td>Nama Barang <td><input type=text name=nm_brg size=50 required>

        <tr><td>Merek<td>
        <select name=kd_merek required>
                <option value=>Pilih Merek-</option>";
                $sql_merek = mysqli_query($conn, "select* from merek order by nm_merek");
                while ($m = mysqli_fetch_array($sql_merek)) {
                        echo "<option value=$m[kd_merek]>$m[nm_merek]";
                }
                echo "</select>

        <tr><td>Kelompok <td>
        <select name=kd_kel required>
                <option value=>-Pilih Kelompok-</option>";
                $sql_kelompok = mysqli_query($conn, "select* from kelompok order by nm_kel");
                while ($m = mysqli_fetch_array($sql_kelompok)) {
                        echo "<option value=$m[kd_kel]>$m[nm_kel]";
                }
                echo "</select>

        <tr><td>Harga Beli <td><input type=text name=hrg_beli size=10 required>

        <tr><td>Harga Jual <td><input type=text name=hrg_jual size=10 required>

        <tr><td>Stock <td><input type=text name=stock size=10 required>
        <tr><td><td><input type=submit name=proses value=SIMPAN>            
        </table>";
                break;

        case "edit":
                $tampil = mysqli_query($conn, "select*from barang where kd_brg='$_GET[kd_brg]'");
                $r = mysqli_fetch_array($tampil);
                
                echo "<center>FORM EDIT DATA BARANG
                <table border=1>
                <form action='master.php' method=POST>

                <input type=hidden name=act value=edit>
                <input type=hidden name='kd_brg'     value='$r[kd_brg]' size=10 required>
                <tr><td>Kode Barang     <td><input type=text name='kd_brg1'     value='$r[kd_brg]' size=10 required>
                <tr><td>Nama Barang     <td><input type=text name='nm_brg'     value='$r[nm_brg]' size=50 required>
                
                <tr><td>Kode Merek   <td> <select name='kd_merek' required> 
                <option value=>-Pilih Merek-</option>";
                $sql_merek = mysqli_query($conn, "select* from merek order by kd_merek");
                while ($m1 = mysqli_fetch_array($sql_merek)) 
                {
                        if ($m1[kd_merek] == $r[kd_merek]) 
                        {
                                echo "<option value='$m1[kd_merek]' selected>$m1[nm_merek]</option>";
                        } 
                        else 
                        {
                                echo "<option value='$m1[kd_merek]'>$m1[nm_merek]</option>";
                        }
                }
                echo "</select>

                <tr><td>Kode Kelompok   <td> <select name=kd_kel required> 
                <option value=>-Pilih Kelompok-</option>";
                $sql_kel = mysqli_query($conn, "select* from kelompok order by nm_kel");
                while ($m1 = mysqli_fetch_array($sql_kel)) 
                {
                        if ($m1[kd_kel] == $r[kd_kel]) 
                        {
                                echo "<option value='$m1[kd_kel]'selected>$m1[nm_kel]</option>";
                        } 
                        else 
                        {
                                echo "<option value='$m1[kd_kel]'>$m1[nm_kel]</option>";
                        }
                }
                echo "</select>

                <tr><td>Harga Beli<td> <input type=text name=hrg_beli value='$r[hrg_beli]' size=10 required>

                <tr><td>Harga Jual<td> <input type=text name=hrg_jual value='$r[hrg_jual]' size=10 required>
                
                <tr><td>Stock<td> <input type=text name=stock value='$r[stock]' size=10 required> 


                <tr><td><td><input type=submit name=proses value=UPDATE>
        

        </table>";
                break;
}
?>
