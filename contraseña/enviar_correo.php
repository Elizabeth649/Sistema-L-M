<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta
require '../DB/conexion.php'; // Incluir la conexión a la base de datos

function enviarCorreo($destinatario, $asunto, $cuerpo) {
    $mail = new PHPMailer(true); // Crea una instancia de PHPMailer

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Especifica el servidor SMTP
        $mail->SMTPAuth   = true; // Habilita la autenticación SMTP
        $mail->Username   = '2002.k.elizabeth@gmail.com'; // Tu dirección de correo
        $mail->Password   = 'dtnp yjbt rbdp wgfv'; // Tu contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Habilita TLS
        $mail->Port       = 587; // Puerto TCP para TLS

        // Configuración de la codificación
        $mail->CharSet = 'UTF-8'; // Establece la codificación a UTF-8

        // Remitente y destinatario
        $mail->setFrom('2002.k.elizabeth@gmail.com', 'Kenia Contreras'); // Nombre con caracteres especiales
        $mail->addAddress($destinatario); // Agrega el destinatario

        // Contenido del correo
        $mail->isHTML(true); // Establece el formato del correo a HTML
        $mail->Subject = $asunto; // Asunto del correo con codificación correcta
        $mail->Body    = $cuerpo; // Cuerpo del correo

        // Enviar el correo
        $mail->send();
        echo 'El correo ha sido enviado';
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $destinatario = $_POST['email']; // Asume que el correo se obtiene de un formulario
    $asunto = 'Recuperación de contraseña'; // Asunto con caracteres especiales

    // Generar un token único
    $token = bin2hex(random_bytes(16)); // Genera un token aleatorio

    // Guardar el token en la base de datos
    $sql = "UPDATE usuarios SET token = ? WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $token, $destinatario);

    if ($stmt->execute()) {
        $linkRecuperacion = 'http://localhost/L&M%20nuevos%20cambios/contrase%C3%B1a/restablecer_contra.php?token=' . $token;

        // Cuerpo del correo con el enlace de recuperación
        $cuerpo = 'Para recuperar tu contraseña, haz clic en el siguiente enlace: <a href="' . $linkRecuperacion . '">Recuperar contraseña</a>';

        enviarCorreo($destinatario, $asunto, $cuerpo);
    } else {
        echo "Error al guardar el token: " . $stmt->error;
    }
}
?>
<!-- Botón para volver a la página de inicio de sesión -->
<div style="margin-top: 20px;">
    <a href="../index.php">
        <button style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">
            Volver a Iniciar Sesión
        </button>
    </a>
</div>
