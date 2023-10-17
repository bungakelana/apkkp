<?php
switch (@$_GET['act']) 
{
        default:
                echo "
                <a href='index.php?menu=supplier&act=tambah'>Tambah</a>
                <br>
                <table border=1>
                <tr><td> NO 
                <td> NAMA SUPPLIER
                <td> ALAMAT
                <td> KOTA
                <td> NO HP";
                $no=0;
                $tampil = mysqli_query($conn,"select*from supplier");
                while ($r = mysqli_fetch_array($tampil)) 
                {
                        $no=$no+1;
                        echo "<tr><td>$no
                        <td>$r[nm_sup]
                        <td>$r[alamat]
                        <td>$r[kota]
                        <td>$r[no_hp]
                        <td><a href='?act=edit&id_sup=$r[id_sup]'>Edit</a>
                        <td><a href='master.php?act=hapus&id_sup=$r[id_sup]'>Hapus</a>";
                }
                echo "</table>";
                break;
        
        case "tambah":
                echo "<center>FORM INPUT SUPPLIER
        <table border=1>
        <form action='master.php' method=POST>
        <input type=hidden name=act value=tambah>
        
        <tr><td>Nama Supplier <td><input type=text name=nm_sup size=30 required>
        <tr><td>Alamat <td><input type=text name=alamat size=50 required>
        <tr><td>Kota <td><input type=text name=kota size=20 required>
        <tr><td>NO HP <td><input type=text name=no_hp size=20 required>
        
        <tr><td><td><input type=submit name=proses value=SIMPAN>            
        </table>";
                break;
        
        case "edit":
                        $tampil=mysqli_query($conn,"select*from supplier where id_sup='$_GET[id_sup]'");
                        $r=mysqli_fetch_array($tampil);
                        echo "<center>FORM EDIT DATA SUPPLIER
                        <table border=1>
                        <form action='master.php' method=POST>
                        <input type=hidden name=act value=edit>
                        <input type=hidden name=id_sup value='$_GET[id_sup]'>
                                                
                        <tr><td>Kode Supplier <td><input type=text name=id_sup1 value='$r[id_sup]' size=10 required>
                        <tr><td>Nama Supplier <td><input type=text name=nm_sup value='$r[nm_sup]' size=30 required>
                        <tr><td>Alamat <td><input type=text name=alamat value='$r[alamat]' size=50 required>
                        <tr><td>Kota <td><input type=text name=kota value='$r[kota]' size=20 required>
                        <tr><td>NO HP <td><input type=text name=no_hp value='$r[no_hp]' size=20 required>
                                                
                        <tr><td><td><input type=submit name=proses value=UPDATE>
                        </table>";
                        break;
                        
        
        }
        
        ?>                