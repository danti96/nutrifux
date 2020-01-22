<?php

// Llamando a los campos

$nombre = $_POST['name'];
$correo = $_POST['email'];
$mensaje = $_POST['message'];

// Datos para el correo
$destinatario = "deiconarburquerque@gmail.com";
$asunto = $_POST['subject'];

$carta = "De: $nombre \n";
$carta .= "Correo: $correo \n";
$carta .= "Asunto: $asunto \n";
$carta .= "Mensaje:\n $mensaje";


// Enviando Mensaje
mail($destinatario, $asunto, $carta);
echo'<script type="text/javascript">
        alert("Mensaje Enviado");
     window.location.href="Age_contacto.php";
        </script>';
?>