<?php

session_start();

if(!isset($_SESSION['login'])){   
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
$tanggal_terima_surat      = "";
$nomor_surat               = "";
$tanggal_surat             = "";
$sifat_surat               = "";
$isi_ringkasan             = ""; 
$kepada                    = "";
$keterangan                = "";
$berkas                    = "";
$sukses                    = "";
$error                     = "";

if(isset($_GET['op'])){
  $op =$_GET['op'];
}else{
  $op = "";
}
if ($op == 'delete') {
  $id         = $_GET['id'];
  $sql1       ="delete from surat_dinas_keluar where id = '$id'";
  $q1         = mysqli_query($koneksi,$sql1);
  if($q1){
    $sukses   ="Berhasil Hapus data"; 
  }else{
    $error    ="Gagal melakukan delete data";
  }
}

if($op =='edit'){
  $id   = $_GET['id'];
  $sql1 = "select * from surat_dinas_keluar where id ='$id'";
  $q1   = mysqli_query($koneksi,$sql1);
  $r1   = mysqli_fetch_array($q1);
  $tanggal_terima_surat     =$r1['tanggal_terima_surat'];
  $nomor_surat              =$r1['nomor_surat'];
  $tanggal_surat            =$r1['tanggal_surat'];
  $sifat_surat              =$r1['sifat_surat'];
  $isi_ringkasan            =$r1['isi_ringkasan'];
  $kepada                   =$r1['kepada'];
  $keterangan               =$r1['keterangan'];
  $berkas                   =$r1['berkas'];
if($nomor_surat ==''){
  $error = "Data tidak ditemukan";
}
}
if(isset($_POST['simpan'])){ //untek create
    $tanggal_terima_surat      = $_POST['tanggal_terima_surat'];
    $nomor_surat               = $_POST['nomor_surat'];
    $tanggal_surat             = $_POST['tanggal_surat'];
    $sifat_surat               = $_POST['sifat_surat'];
    $isi_ringkasan             = $_POST['isi_ringkasan'];
    $kepada                    = $_POST['kepada'];
    $keterangan                = $_POST['keterangan'];
    $berkas                    = $_POST['berkas'];
    

    if( $tanggal_terima_surat && $nomor_surat && $tanggal_surat && $sifat_surat && $isi_ringkasan  && $kepada && $keterangan && $berkas){
       if($op =='edit'){//untk update
        $sql1     ="update surat_dinas_keluar set tanggal_terima_surat ='$tanggal_terima_surat',nomor_surat ='$nomor_surat',tanggal_surat='$tanggal_surat',sifat_surat ='$sifat_surat',isi_ringkasan ='$isi_ringkasan',kepada ='$kepada',keterangan ='$keterangan',berkas='$berkas' where id ='$id'";
        $q1       =mysqli_query($koneksi,$sql1);
        if($q1){
          $sukses = "Data Berhasil DI UPDATE";
        }else{
          $error = "Data Gagal Di UPDATE";
        } 
      }else{ //untuk insert
        $sql1 = "insert into surat_dinas_keluar (tanggal_terima_surat,nomor_surat,tanggal_surat,sifat_surat,isi_ringkasan,kepada,keterangan,berkas) values ('$tanggal_terima_surat','$nomor_surat','$tanggal_surat','$sifat_surat','$isi_ringkasan','$kepada','$keterangan','$berkas')";
      $q1   = mysqli_query($koneksi,$sql1);
      if($q1){
        $sukses  = "Berhasil memasukan data baru";
      }else{
        $error   = "Gagal Memasukan data";
      }
      }
      
      
    }else{
        $error =" Silahkan masukan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INPUT SURAT KELUAR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
    .mx-auto{width: 1200px;}
    .card{margin-top: 10px;}
    
    </style>

</head>

<body>
    <div class="mx-auto">

<!--untuk mengeluarkan data-->

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
    <th scope="col">Kepada</th>
    <th scope="col">Keterangan</th>
    <th scope="col">Berkas</th>
    </tr>
    <tbody>
        <?php
        $sql2 ="select * from surat_dinas_keluar order by id desc";
        $q2   =mysqli_query($koneksi,$sql2);
        $urut = 1;
        while($r2 = mysqli_fetch_array($q2)){
         $id                          = $r2['id'];
         $tanggal_terima_surat        = $r2['tanggal_terima_surat'];
         $nomor_surat                 = $r2['nomor_surat'];
         $tanggal_surat               = $r2['tanggal_surat'];
         $sifat_surat                 = $r2['sifat_surat'];
         $isi_ringkasan               = $r2['isi_ringkasan'];
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
    <script type="text/javascript">
        window.print();
    </script>
  </div>
</div>
    </div>
</body>
</html>
