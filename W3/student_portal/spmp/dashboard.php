<?php
 session_start();

    if(!isset($_SESSION['loggedin'])) {
        header("location:login.php");
        exit();
    }

?>

<html>
    <head>
</head>
<body>
    <h3>THIS IS A DASHBOARD <?php echo $_SESSION['username']; ?></h3>
    <a href="aboutme.php">TENTANG SAYA.</a>
    <a href="index.php">INDEKS.</a>
    <a href="logout.php">KELUAR </a>
</body>
</html>