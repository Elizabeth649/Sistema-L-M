<?php
// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '', 'inventario_lym');

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha pasado un ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID no proporcionado.";
    exit();
}

$id = intval($_GET['id']); // Asegurarse de que el ID sea un entero

// Consultar los datos del producto
$query = "SELECT * FROM productos WHERE id = $id";
$result = $conn->query($query);

if (!$result) {
    echo "Error en la consulta SQL: " . $conn->error;
    exit();
}

if ($result->num_rows > 0) {
    $producto = $result->fetch_assoc();
} else {
    echo "Producto no encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Liquidación</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body>
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-3/4">
            <h2 class="flex items-center justify-center space-x-4 bg-pink-200 mb-4">ENVIAR PRODUCTO A LIQUIDACIÓN</h2>
            <form class="grid grid-cols-2 gap-4" action="guardar_liquidacion.php" method="POST">
                <div>
                    <label class="block mb-2" for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" class="w-full p-2 border border-gray-300 rounded bg-purple-100" readonly>
                </div>

                <div>
                    <label class="block mb-2" for="descripcion">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" class="w-full p-2 border border-gray-300 rounded bg-purple-100" readonly><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
                </div>

                <div>
                    <label class="block mb-2" for="cantidad">Cantidad:</label>
                    <input type="number" name="cantidad" id="cantidad" value="<?php echo htmlspecialchars($producto['cantidad']); ?>" class="w-full p-2 border border-gray-300 rounded bg-purple-100" readonly>
                </div>

                <div>
                    <label class="block mb-2" for="costo">Costo de Liquidación:</label>
                    <input type="number" name="costo" id="costo" step="0.01" class="w-full p-2 border border-gray-300 rounded bg-purple-100">
                </div>

                <div>
                    <label class="block mb-2" for="estado">Estado:</label>
                    <select name="estado" id="estado" class="w-full p-2 border border-gray-300 rounded bg-purple-100" required>
                        <option value="Nuevo">Nuevo</option>
                        <option value="Descartado">Descartado</option>
                        <option value="De Temporada">De Temporada</option>
                        <option value="Liquidacion">Liquidación</option>
                    </select>
                </div>

                <input type="hidden" name="id_producto" value="<?php echo $producto['id']; ?>">

                <div class="flex items-end justify-start space-x-4 col-span-2">
                    <button type="button" class="bg-yellow-400 text-black font-bold py-2 px-4 rounded" onclick="window.history.back()">Cancelar</button>
                    <button type="submit" class="bg-green-500 text-black font-bold py-2 px-4 rounded">Guardar Liquidación</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
