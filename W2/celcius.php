<html>
<head>
</head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<label>Kelvin(k)</label>
<input name="kelvinVal">
<input type="submit" value="calculate">
</form>
</body>

<?php
if($_SERVER['REQUEST_METHOD']=="POST") {
$kelvin = $_POST['kelvinVal'];

$celcius = $kelvin - 273.15;
}
?>

<?php
echo $celcius;
?>
</html>