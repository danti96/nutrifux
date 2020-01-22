<?php 
$database = "localhost";
$username = "id10111532_root";
$passwrd = "123456789";
$nameserver = "id10111532_nutrifux";

$mysqli=mysqli_connect($database,$username,$passwrd,$nameserver);

if(!$mysqli){
	die.("Error al conectar:".mysqli_connect_error());
}
?>
