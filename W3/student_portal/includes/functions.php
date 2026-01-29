<?php
function isValidUser ($user,$pass){
    $admin_user = "najhan@gmail.com";
    $admin_pass = "1234";

    return($user===$admin_user&&$pass===$admin_pass);
}

?>