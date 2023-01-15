<?php

session_start();

$host      = "localhost";
$user      = "root";
$pass      = "";
$db        = "arsiparis";

$koneksi   = mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){// cek koneksi
     die("Tidak bisa koneksi ke database");
}
 
// cek apakah yang mengakses halaman ini sudah login
if(!isset($_SESSION['login'])){   
  header("location:index.php");
  exit;
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
      <!--untuk memasukan data-->
     <div class="card">
  <div class="card-header d-flex justify-content-between">
    INPUT SURAT DINAS KELUAR
    <a href="./dashboard.php" class="btn btn-secondary">back</a>
  </div>
  <div class="card-body">
    <?php
    if($error){
        ?>
        <div class="alert alert-danger" role="alert">
  <?php echo $error ?>
</div>
<?php
  header("refresh:3;url=surat_keluar.php");//5 detik    
}
    ?>
    <?php
    if($sukses){
        ?>
        <div class="alert alert-success" role="alert">
  <?php echo $sukses ?>
</div>
<?php 
header("refresh:3;url=surat_keluar.php");//5 detik   
}
    ?>
    <form action="" method="POST">
    <div class="mb-3 row">
    <label for="nim" class="col-sm-2 col-form-label">Tanggal Penerimaan Surat</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="tanggal_terima_surat" name="tanggal_terima_surat" value="<?php echo $tanggal_terima_surat?>">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="nama" class="col-sm-2 col-form-label">Nomor Surat</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nomor_surat" name ="nomor_surat" value="<?php echo $nomor_surat?>">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="alamat" class="col-sm-2 col-form-label">Tanggal_Surat</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="tanggal_surat" name ="tanggal_surat" value="<?php echo $tanggal_surat?>">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="nama" class="col-sm-2 col-form-label">Sifat Surat</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="sifat_surat" name ="sifat_surat" value="<?php echo $sifat_surat?>">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="nama" class="col-sm-2 col-form-label">Isi Ringkasan</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="isi_ringkasan" name ="isi_ringkasan" value="<?php echo $isi_ringkasan?>">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="nama" class="col-sm-2 col-form-label">Kepada</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="kepada" name ="kepada" value="<?php echo $kepada?>">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="nama" class="col-sm-2 col-form-label">Keterangan</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="keterangan" name ="keterangan" value="<?php echo $keterangan?>">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="nama" class="col-sm-2 col-form-label">Berkas</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" id="berkas" name ="berkas" value="<?php echo $berkas?>">
    </div>
  </div>
  
  <div class="col-12">
      <input type="submit" name="simpan"value="Simpan Data" class="btn btn-primary"/>
  </div>
    </form>
  </div>
</div>

<!--untuk mengeluarkan data-->

<div class="card">
  <div class="card-header text-white bg-secondary">
     Data Surat Dinas Masuk
  </div>
  <div class="card-body">
  <a class="d-flex justify-content-end" target="_blank" href="cetak_keluar.php"><button type="button" class="btn btn-primary ">Print</button></a>
   <table class="table">
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
    <th scope="col">Aksi</th>
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
          <td scope= "row">
            <a href="surat_keluar.php?op=edit&id=<?php echo $id?>"><button type="button" class="btn btn-warning">Edit</button></a>
            <a href="surat_keluar.php?op=delete&id=<?php echo $id?>" onclick= "return confirm('yakin mau delete data')"><button type="button" class="btn btn-danger">Delete</button></a>
          </td>
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
