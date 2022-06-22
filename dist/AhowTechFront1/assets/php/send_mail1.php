<?php
//Recipiente
$to = 'INSERTADO POR CAMPO INPUT';

//remitente del correo
$from = 'remitente@remitente.com';
$fromName = 'Remitente';

//Asunto del email
$subject = 'Este es el asunto de mi mensaje';

//Ruta del archivo adjunto
$file = "./assets/cconformidad.pdf";

//Contenido del Email
$htmlContent = '<h1 style="background-color: #cf142b;text-align: center;color: #fff;padding: 5px;text-transform: uppercase;border-top: 7px solid #002940;border-bottom: 7px solid #002940; border-radius: 1px;">Hola, esto es una prueba</h1>
    <p style="background-color: #fff;border: 1px solid #c1c1c1;padding: 15px;border-radius: 1px;font-size: 15px;">Podrá encontrar la carta de conformidad adjunta en este e-mail para su descarga.</p>';

//Encabezado para información del remitente
$headers = "De: $fromName"." <".$from.">";

//Limite Email
$semi_rand = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

//Encabezados para archivo adjunto
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

//límite multiparte
$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";

//preparación de archivo
if(!empty($file) > 0){
    if(is_file($file)){
        $message .= "--{$mime_boundary}\n";
        $fp =    @fopen($file,"rb");
        $data =  @fread($fp,filesize($file));

        @fclose($fp);
        $data = chunk_split(base64_encode($data));
        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .
        "Content-Description: ".basename($files[$i])."\n" .
        "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
    }
}
$message .= "--{$mime_boundary}--";
$returnpath = "-f" . $from;

//Enviar EMail
$mail = @mail($to, $subject, $message, $headers, $returnpath);

//Estado de envío de correo electrónico
echo $mail?"<h1>Correo enviado.</h1>":"<h1>El envío de correo falló.</h1>";
