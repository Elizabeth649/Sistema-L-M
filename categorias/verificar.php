<?php
header('Content-Type: application/json');

// Conexión a la base de datos (ajusta los parámetros según tu configuración)
$host = 'localhost'; // o tu servidor de base de datos
$dbname = 'inventario_lym';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener el ID de la categoría desde la consulta
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    // Verificar si la categoría tiene productos asociados
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM productos WHERE categoria_id = :id");
    $stmt->execute(['id' => $id]);
    $count = $stmt->fetchColumn();

    // Devolver el resultado
    echo json_encode(['hasProducts' => $count > 0]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
