<?php 
echo "
<table border=1>
        <tr> 
        <td>NO
        <td>TANGGAL FAKTUR
        <td>KODE BARANG
        <td>NAMA BARANG
        <td>JUMLAH
        <td>HARGA
        <td>TOTAL ";
        $no = 0;
        $tampil = mysqli_query($conn, "select * from detail_beli join barang 
        on detail_beli.kd_brg=barang.kd_brg where id_faktur='$id_faktur'");
        while ($r = mysqli_fetch_array($tampil))
         {
              $no = $no + 1;
              $total=$r[harga]*$r[jumlah];
              $rharga=number_format($r[harga]);
              $rtotal=number_format($total);
              $gtotal=$gtotal+$total;
              $rgtotal=number_format($gtotal);
                echo "<tr>
                <td>$no
                <td>$r[tgl_faktur]
                <td>$r[kd_brg]
                <td>$r[nm_brg]
                <td><div align=right>$r[jumlah]
                <td><div align=right>$rharga
                <td><div align=right>$rtotal
             
                <td><a href='index.php?act=edit1&id_faktur=$r[id_faktur]&id_beli=$r[id_beli]'>Edit</a>
                <td><a href='master.php?act=hapus1&id_faktur=$r[id_faktur]&id_beli=$r[id_beli]'>Hapus</a>";
         }        
        echo "
       <tr><td><td><td><td><td><td>Grand Total <td><div align=right>$rgtotal</div>
        
        </table>";
        
      
    ?>
