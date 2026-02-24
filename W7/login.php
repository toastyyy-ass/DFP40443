<?php 
$config = include('config/app_config.php')
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $config['site_name']?></title>
</head>
<body>
    <form action="test_connection.php"method="POST">
        User <input name = "username" type="text">
        Password <input name = "password" type="password">
        <input type="submit" value="Login">
</form>
</body>
</html>