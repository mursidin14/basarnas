<?php

session_start();

if(!isset($_SESSION['user'])){   
  header("location:index.php");
  exit;
}

$host      = "localhost";
$user      = "root";
$pass      = "";
$db        = "arsiparis";

$koneksi   = mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){// cek koneksi
     die("Tidak bisa koneksi ke database");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INPUT SURAT MASUK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
    .mx-auto{width: 1200px;}
    .card{margin-top: 10px;}
    
    </style>

</head>

<body>

<!--untuk mengeluarkan data-->
<div class="max-auto">
   <div class="d-flex justify-content-end">
    <a class="nav-link px-3 text-white m-3" href="./logout.php"><button class="btn btn-secondary">Logout</button></a>
   </div> 
<div class="card">
  <div class="card-header text-white bg-secondary">
     Data Surat Dinas Masuk
  </div>
  <div class="card-body">
   <table class="table table-bordered border-secondary">
   <thead>
    <tr>
    <th scope="col">No</th>
    <th scope="col">Tanggal Terima Surat</th>
    <th scope="col">Nomor Surat</th>
    <th scope="col">Tanggal Surat</th>
    <th scope="col">Sifat Surat</th>
    <th scope="col">Isi Ringkasan</th>
    <th scope="col">Dari</th>
    <th scope="col">Kepada</th>
    <th scope="col">Keterangan</th>
    <th scope="col">Berkas</th>
    </tr>
    <tbody>
        <?php
        $sql2 ="select * from surat_dinas_masuk order by id desc";
        $q2   =mysqli_query($koneksi,$sql2);
        $urut = 1;
        while($r2 = mysqli_fetch_array($q2)){
         $id                          = $r2['id'];
         $tanggal_terima_surat        = $r2['tanggal_terima_surat'];
         $nomor_surat                 = $r2['nomor_surat'];
         $tanggal_surat               = $r2['tanggal_surat'];
         $sifat_surat                 = $r2['sifat_surat'];
         $isi_ringkasan               = $r2['isi_ringkasan'];
         $dari                        = $r2['dari'];
         $kepada                      = $r2['kepada'];
         $keterangan                  = $r2['keterangan'];
         $berkas                      = $r2['berkas'];
        ?>
        <tr>
          <th scope= "row"><?php echo $urut++ ?> </th>
          <td scope= "row"><?php echo $tanggal_terima_surat ?></td>
          <td scope= "row"><?php echo $nomor_surat ?></td>
          <td scope= "row"><?php echo $tanggal_surat ?></td>
          <td scope= "row"><?php echo $sifat_surat ?></td>
          <td scope= "row"><?php echo $isi_ringkasan ?></td>
          <td scope= "row"><?php echo $dari ?></td>
          <td scope= "row"><?php echo $kepada ?></td>
          <td scope= "row"><?php echo $keterangan ?></td>
          <td scope= "row"><?php echo $berkas ?></td>
          </tr>

        <?php
        }
        ?>
    </tbody>
   </thead>
   </table>
  </div>
</div>
    </div>

    <div class="max-auto">
<div class="card">
  <div class="card-header text-white bg-secondary">
     Data Surat Dinas Keluar
  </div>
  <div class="card-body">
   <table class="table table-bordered border-secondary">
   <thead>
    <tr>
    <th scope="col">No</th>
    <th scope="col">Tanggal Terima Surat</th>
    <th scope="col">Nomor Surat</th>
    <th scope="col">Tanggal Surat</th>
    <th scope="col">Sifat Surat</th>
    <th scope="col">Isi Ringkasan</th>
    <th scope="col">Dari</th>
    <th scope="col">Kepada</th>
    <th scope="col">Keterangan</th>
    <th scope="col">Berkas</th>
    </tr>
    <tbody>
        <?php
        $sql2 ="select * from surat_dinas_masuk order by id desc";
        $q2   =mysqli_query($koneksi,$sql2);
        $urut = 1;
        while($r2 = mysqli_fetch_array($q2)){
         $id                          = $r2['id'];
         $tanggal_terima_surat        = $r2['tanggal_terima_surat'];
         $nomor_surat                 = $r2['nomor_surat'];
         $tanggal_surat               = $r2['tanggal_surat'];
         $sifat_surat                 = $r2['sifat_surat'];
         $isi_ringkasan               = $r2['isi_ringkasan'];
         $dari                        = $r2['dari'];
         $kepada                      = $r2['kepada'];
         $keterangan                  = $r2['keterangan'];
         $berkas                      = $r2['berkas'];
        ?>
        <tr>
          <th scope= "row"><?php echo $urut++ ?> </th>
          <td scope= "row"><?php echo $tanggal_terima_surat ?></td>
          <td scope= "row"><?php echo $nomor_surat ?></td>
          <td scope= "row"><?php echo $tanggal_surat ?></td>
          <td scope= "row"><?php echo $sifat_surat ?></td>
          <td scope= "row"><?php echo $isi_ringkasan ?></td>
          <td scope= "row"><?php echo $dari ?></td>
          <td scope= "row"><?php echo $kepada ?></td>
          <td scope= "row"><?php echo $keterangan ?></td>
          <td scope= "row"><?php echo $berkas ?></td>
          </tr>

        <?php
        }
        ?>
    </tbody>
   </thead>
   </table>
    </div>
    </div>
    </div>
</body>
</html>
