<?php 

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $config['site_name']?></title>
</head>
<body>
    <h1>PHP Knowledge Questions</h1>
    <p1>Answer ALL questions.<p1>
    <form action="q1.php"method="POST">
        <br>
        Enter Name: <input name = "username" type="text">
        <input type="submit" value="Start Quiz">
</form>
</body>
</html>