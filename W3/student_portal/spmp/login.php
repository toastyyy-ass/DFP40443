<?php 
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $namapengguna=$_POST['user'];
    $katalaluan = $_POST['pass'];
if($namapengguna == "najhan" && $katalaluan == "root") {
    $_SESSION['username'] = $namapengguna;
    $_SESSION['loggedin'] = true;
header("location:dashboard.php");
exit();
}
}
?>
<form method="POST" action="">
    User<input name="user" type="text">
    Password<input name="pass" type="password">
    <input type="submit" value="login">
</form>

