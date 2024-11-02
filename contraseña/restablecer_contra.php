<?php
require '../DB/conexion.php'; // Incluir la conexión a la base de datos

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Validar el token aquí
    $sql = "SELECT * FROM usuarios WHERE token = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Mostrar formulario para restablecer contraseña
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Restablecer Contraseña</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 20px;
                    text-align: center;
                }
                h1 {
                    color: #333;
                }
                form {
                    background: white;
                    padding: 20px;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    display: inline-block;
                }
                label {
                    display: block;
                    margin: 10px 0 5px;
                    color: #555;
                }
                input[type="password"] {
                    width: 100%;
                    padding: 10px;
                    margin-bottom: 10px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                }
                button {
                    background-color: #007bff;
                    color: white;
                    padding: 10px 15px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                }
                button:hover {
                    background-color: #0056b3;
                }
                .logo {
                    max-width: 150px;
                    margin-bottom: 20px;
                }
            </style>
        </head>
        <body>
            <img src="../img/logo.png" alt="Logo" class="logo">
            <h1>Restablecer Contraseña</h1>
            <form method="post" action="actualizar_contra.php">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                <label for="nueva_contra">Nueva Contraseña:</label>
                <input type="password" name="nueva_contra" required>
                <button type="submit">Cambiar Contraseña</button>
            </form>
        </body>
        </html>
        <?php
    } else {
        echo 'Token no válido.';
    }
} else {
    echo 'Token no válido.';
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