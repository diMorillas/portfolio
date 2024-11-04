<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Datos del formulario
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validación básica
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, ingresa un correo electrónico válido.";
        exit;
    }

    // Configuración del correo
    $to = "didacmorillas19@gmail.com";
    $email_subject = "Nuevo mensaje de contacto: $subject";
    $email_body = "Has recibido un nuevo mensaje de contacto.\n\n" .
                  "Nombre: $name\n" .
                  "Correo electrónico: $email\n" .
                  "Asunto: $subject\n" .
                  "Mensaje:\n$message\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Enviar el correo
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "¡Gracias por tu mensaje, $name! Me pondré en contacto contigo pronto.";
    } else {
        echo "Lo sentimos, hubo un problema al enviar tu mensaje. Por favor, intenta de nuevo.";
    }
}
?>
