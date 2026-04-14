<?php
include 'db.php';
$sql = "SELECT * FROM users";

$result = mysqli_query($conn,$ssql);
$output = "<ul>";

while ($row = mysqli_fetch_assoc($result)) {
    $output.="<li>".$row['username']."</li>";
}

$output.="</ul>";

echo $output;
?>