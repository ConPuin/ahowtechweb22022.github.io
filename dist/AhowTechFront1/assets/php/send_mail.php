
<?php
// El mensaje
$to = "ahowtech2022@gmail.com";
$subject = "Solicitud de Información de " & 'fname';

$mensaje = "Línea 1\r\nLínea 2\r\nLínea 3";

// Si cualquier línea es más larga de 70 caracteres, se debería usar wordwrap()
$mensaje = wordwrap($mensaje, 70, "\r\n");

$headers = "From: " & 'email';

// Enviarlo
//mail('conpuin@gmail.com',"Solicitud de Información de " & 'fname' & '--' & 'email', $mensaje);
mail($to, $subject, $message, $headers);
?>
