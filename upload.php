
<h3>Upload dokumen</h3>
<form action="" method="POST" enctype="multipart/form-data">
<b>File Upload</b><input type="file" name="NamaFile">
<input type="submit" name="proses" value="Upload">
</form>
<?php
$host      = "localhost";
$user      = "root";
$pass      = "";
$db        = "arsiparis";

$koneksi   = mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){// cek koneksi
     die("Tidak bisa koneksi ke database");
}
if(isset($_POST['proses'])){
    $direktori ="berkas/";
    $file_name=$_FILES['NamaFile']['name'];
    move_uploaded_file($_FILES['NamaFile']['tmp_name'],$direktori.$file_name);
   mysqli_query($koneksi,"insert into dokumen set file='$file_name'");
echo"<b> File berhasil diupload";
}
?>