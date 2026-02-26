
<?php
require_once 'congig/app_config.php';{
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $username = htlspecialcharacters($_POST['username']);
    $password = htlspecialcharacters($_POST['password']);

    if(isset($users[$username]) && $users[$username] == $password) {
        header('Location: quiz.php')
    }else{
        $error = "invalid username or password";

    }
}
}
$pageTitle = 'Login';
require_oce 'includes/header.php';
?>

    <h1> WELCOME TO THE QUIZ </h1>
    <p> enter your name to begin </p>
        <?php if ($error): ?>
        <?php echo $error : ?>
