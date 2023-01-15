<?php 

session_start();
if(isset($_SESSION['login'])){   
    header("location:dashboard.php");
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
 
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_login WHERE username='$username' AND password = md5('$password') ");

    $cek = mysqli_num_rows($sql);
    // $result = mysqli_query($conn, $sql);
    if ($cek > 0) {
        // $row = mysqli_fetch_assoc($result);
        $_SESSION['login'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('username atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}

// menangkap data yang dikirim dari form login
// $username = $_POST['username'];
// $password = $_POST['password'];

// menyeleksi data user dengan username dan password yang sesuai
// $login = mysqli_query($koneksi,"select * from tb_login where username='$username' and password= md5 ('$password')");

// menghitung jumlah data yang ditemukan
// $cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
// if($cek > 0){
 
// 	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai admin
	// if($data['level']=="admin"){
 
		// buat session login dan username
		// $_SESSION['username'] = $username;
		// $_SESSION['level'] = "admin";
		// alihkan ke halaman dashboard admin
		// header("location:dashboard.php");
 
	// cek jika user login sebagai pegawai
	// }
    // else if($data['level']=="pegawai"){
		// buat session login dan username
		// $_SESSION['username'] = $username;
		// $_SESSION['level'] = "pegawai";
		// alihkan ke halaman dashboard pegawai
		// header("location:index.php");
 
	// cek jika user login sebagai pengurus
	// }
    // else{
 
		// alihkan ke halaman login kembali
//         echo "<script>alert('username atau password Anda salah. Silahkan coba lagi!')</script>";
// 	}	
// }else{
//     echo "<script>alert('username atau password Anda salah. Silahkan coba lagi!')</script>";
// }
 
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" type="text/css" href="style.css">
 
    <title>Login</title>
</head>
<body>
    <!-- <div class="alert alert-warning" role="alert">
     <?php 
    //  echo $_SESSION['error']
     ?>
    </div> -->
 
    <div class="container">
        <form method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <!-- <input type="submit" class="btn" value="Login" /> -->
                <button type="submit" class="btn" name="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>