<?php
   include 'include/session.php';
   $idnasabah=$_POST['idnasabah'];
   $queryget = mysqli_query($conn,"SELECT NO_REKENING,JENIS_PINJAMAN,POKOK_SALDO_REALISASI,POKOK_SALDO_AKHIR,DESKRIPSI_JENIS_KREDIT FROM kredit a LEFT JOIN kodejeniskredit b ON a.JENIS_PINJAMAN=b.KODE_JENIS_KREDIT WHERE a.nasabah_id LIKE '%$idnasabah%'");
   while($dataget = mysqli_fetch_assoc($queryget)){
   echo $dataget['NO_REKENING'].'/'.$dataget['JENIS_PINJAMAN'].'/'.$dataget['POKOK_SALDO_REALISASI'].'/'.$dataget['POKOK_SALDO_AKHIR'].'/'.$dataget['DESKRIPSI_JENIS_KREDIT'].'|';
   }
?>