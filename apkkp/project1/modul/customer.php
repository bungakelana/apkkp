<?php
switch (@$_GET['act']) 
{
        default:
                echo "
                <a href='index.php?menu=customer&act=tambah'>Tambah</a>
                <br>
                <table border=1>
                <tr><td> NO 
                <td> NAMA CUSTOMER
                <td> ALAMAT
                <td> KOTA
                <td> NO HP";
                $no=0;
                $tampil = mysqli_query($conn,"select*from customer");
                while ($r = mysqli_fetch_array($tampil)) 
                {
                        $no=$no+1;
                        echo "<tr><td>$no
                        <td>$r[nm_cust]
                        <td>$r[alamat]
                        <td>$r[kota]
                        <td>$r[no_hp]
                        <td><a href='?act=edit&id_cust=$r[id_cust]'>Edit</a>
                        <td><a href='master.php?act=hapus&id_cust=$r[id_cust]'>Hapus</a>";
                }
                echo "</table>";
                break;
        
        case "tambah":
                echo "<center>FORM INPUT CUSTOMER
        <table border=1>
        <form action='master.php' method=POST>
        <input type=hidden name=act value=tambah>
        
        <tr><td>Nama Customer <td><input type=text name=nm_cust size=30 required>
        <tr><td>Alamat <td><input type=text name=alamat size=50 required>
        <tr><td>Kota <td><input type=text name=kota size=20 required>
        <tr><td>NO HP <td><input type=text name=no_hp size=20 required>
        
        <tr><td><td><input type=submit name=proses value=SIMPAN>            
        </table>";
                break;
        
        case "edit":
                        $tampil=mysqli_query($conn,"select*from customer where id_cust='$_GET[id_cust]'");
                        $r=mysqli_fetch_array($tampil);
                        echo "<center>FORM EDIT DATA CUSTOMER
                        <table border=1>
                        <form action='master.php' method=POST>
                        <input type=hidden name=act value=edit>
                        <input type=hidden name=id_cust value='$_GET[id_cust]'>
                                                
                        <tr><td>Kode Customer <td><input type=text name=id_cust1 value='$r[id_cust]' size=10 required>
                        <tr><td>Nama Customer <td><input type=text name=nm_cust value='$r[nm_cust]' size=30 required>
                        <tr><td>Alamat <td><input type=text name=alamat value='$r[alamat]' size=50 required>
                        <tr><td>Kota <td><input type=text name=kota value='$r[kota]' size=20 required>
                        <tr><td>NO HP <td><input type=text name=no_hp value='$r[no_hp]' size=20 required>
                                                
                        <tr><td><td><input type=submit name=proses value=UPDATE>
                        </table>";
                        break;
                        
        
        }
        
        ?>                