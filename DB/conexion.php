<?php
// Datos de la base de datos
$servername = "localhost"; // 
$username = "root"; // 
$password = ""; // 
$dbname = "inventario_lym"; // 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>

