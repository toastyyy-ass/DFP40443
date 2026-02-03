<?php
$config = include('config/app_config.php');
require_once('includes/alumni_input.php');

$isLogedIn = false;
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
            $user = $_POST['username'];
            $pass = $_POST['password'];

            if($user !== $config['admin_user'] || $pass !== $config['admin_pass']){

            } $isLoggedIn = true;
        } catch (Exception $e) {

        }
    }
?>
<html>
    <head>
        <title><?php echo $config['site_name']; ?></title>
</head>
    <body style = "background-color: #ce8f30; <?echo $config ['theme_colourS']; ?>">
    <header>
        <nav> 
            <ul style="display: flexible;list-style-type: style none;"> 
                <?php echo generatedMenu($pages);?>
            </ul>
        </nav>
    </header>

    <?php if($isLoggedIn); ?>
    Welcome <?php echo $_POST['username']; ?>
   

    <p> Sed tristique lobortis tortor at congue. Integer ornare egestas blandit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas aliquet est nec velit aliquam, eget commodo lectus porta. In quis felis eget tortor malesuada sollicitudin nec non diam. In volutpat turpis nisi, laoreet placerat tortor convallis at. Sed fringilla libero vitae tortor eleifend, id molestie dui facilisis. Nullam erat tortor, iaculis et augue a, fringilla vulputate nisl. Aenean leo mauris, vulputate iaculis imperdiet in, porta convallis eros. Quisque lectus elit, consectetur sit amet ullamcorper eu, mollis at nunc.</p>
    <hr>
    <footer> <?php echo $config['admin_email']; ?></footer> 
</body>
    </html>