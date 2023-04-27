<?php
   
   // $conn_user = 'root';
   // $conn_pass = 'mmsPNMonl1n3';
   // $conn_db = 'MTECHKONVE';
   // $conn_host = 'localhost';
   // $conn = mysqli_connect($conn_host,$conn_user,$conn_pass,$conn_db);
   
   // // Check connection
   // if (!$conn) {
   //    die("Connection failed: " . mysqli_connect_error());
   // }

   $idnasabah=$_POST['filter'];
   echo 'hasil'.$idnasabah;
   // $queryget = mysqli_query($conn,"SELECT NO_REKENING,JENIS_PINJAMAN,POKOK_SALDO_REALISASI,POKOK_SALDO_AKHIR,DESKRIPSI_JENIS_KREDIT FROM kredit a LEFT JOIN kodejeniskredit b ON a.JENIS_PINJAMAN=b.KODE_JENIS_KREDIT WHERE a.nasabah_id LIKE '%$idnasabah%'");
   // while($dataget = mysqli_fetch_assoc($queryget)){
   // echo $dataget['NO_REKENING'].'/'.$dataget['JENIS_PINJAMAN'].'/'.$dataget['POKOK_SALDO_REALISASI'].'/'.$dataget['POKOK_SALDO_AKHIR'].'/'.$dataget['DESKRIPSI_JENIS_KREDIT'].'|';
   // }
?>