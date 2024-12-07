<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-pink-100">

<?php
session_start(); // Iniciar la sesión
?>

<div id="mensaje" class="fixed right-0 top-20 bg-green-500 text-white p-4 rounded-lg shadow-lg hidden">
    <?php
    if (isset($_SESSION['mensaje'])) {
        echo $_SESSION['mensaje'];
        unset($_SESSION['mensaje']); // Limpia el mensaje después de mostrarlo
    }
    ?>
</div>

<script>
    // Mostrar el mensaje si existe
    const mensajeDiv = document.getElementById('mensaje');
    if (mensajeDiv.innerText) {
        mensajeDiv.classList.remove('hidden');
        setTimeout(() => {
            mensajeDiv.classList.add('hidden');
        }, 2000); // Ocultar después de 2 segundos
    }
</script>


    <div class="flex items-center justify-between p-4">
        <i class="fas fa-bars text-2xl"></i>
        <h1 class="text-center text-2xl font-semibold"></h1>
        <i class="fas fa-user-circle text-2xl"></i>
    </div>
<body class="bg-pink-100">
    <div class="flex">
        <!-- Sidebar -->
        <body class="bg-pink-100">
 
    <div class="flex">
        <div class="flex flex-col space-y-4 p-4">
            <a href="../dashboard.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-home"></i>
                <span>INICIO</span>
            </a>
            <a href="" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-list"></i>
                <span>CATEGORIAS</span>
            </a>
            <a href="../productos/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-box"></i>
                <span>PRODUCTOS</span>
            </a>
            <a href="../proveedores/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-truck"></i>
                <span>PROVEEDORES</span>
            </a>
            <a href="../ventas/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-shopping-cart"></i>
                <span>VENTAS</span>
            </a>
            <a href="../liquidacion/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
            <i class="fas fa-tags"></i>
            <span>LIQUIDACION</span>
            </a>
            <a href="../usuarios/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-user"></i>
                <span>USUARIOS</span>
            </a>
            <a href="../ajustes/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-cog"></i>
                <span>AJUSTES</span>
            </a>
            <a href="../videos de apoyo/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
            <i class="fab fa-youtube"></i>
            <span>VIDEOS DE APOYO</span>
            </a>
            <a href="../logout.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <span>CERRAR SESION</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    
    <div class="w-4/5 p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">CATEGORIAS</h1>
    </div>
    <button class="bg-green-500 text-white py-2 px-4 rounded mb-6" onclick="document.getElementById('addCategoryModal').classList.remove('hidden')">
        <i class="fas fa-plus mr-2"></i> Nueva Categoria
    </button>
    
    <div id="message" style="color: red; margin-bottom: 10px;"></div>

    <table class="min-w-full bg-white">
        <thead>
            <tr class="bg-pink-200 text-left">
                <th class="py-2 px-4 border text-center">Id</th>
                <th class="py-2 px-4 border text-center">Nombre</th>
                <th class="py-2 px-4 border text-center">Descripción</th>
                <th class="py-2 px-4 border">Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conn = new mysqli('localhost', 'root', '', 'inventario_lym');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT id, nombre, descripcion FROM categorias";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr class='border-b'>";
                    echo "<td class='py-2 px-4 border text-center'>" . $row["id"] . "</td>";
                    echo "<td class='py-2 px-4 border text-center'>" . $row["nombre"] . "</td>";
                    echo "<td class='py-2 px-4 border text-center'>" . $row["descripcion"] . "</td>";
                    echo "<td class='py-2 px-4'>";
                    echo "<button class='bg-green-500 text-white py-1 px-3 rounded mr-2' onclick='editCategory(" . $row["id"] . ", \"" . addslashes($row["nombre"]) . "\", \"" . addslashes($row["descripcion"]) . "\")'>Editar</button>";
                    echo "<button class='bg-red-500 text-white py-1 px-3 rounded' onclick='deleteCategory(" . $row["id"] . ")'>Eliminar</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='py-2 px-4'>No hay categorías</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <!-- Modal para editar categoría -->
    <div id="editCategoryModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center">
        <div class="bg-white p-6 rounded shadow-lg">
            <h2 class="flex items-center justify-center space-x-4 bg-pink-200 mb-4">Editar Categoría</h2>
            <input type="hidden" id="editId">
            <label class="block mb-2">Nombre de categoria:</label>
            <input type="text" id="editNombre" class="border px-4 py-2 mb-4 w-full">
            <label class="block mb-2">Descripción de la categoria:</label>
            <input type="text" id="editDescripcion" class="border px-4 py-2 mb-4 w-full">

            <button class="bg-green-500 text-white py-2 px-4 rounded" onclick="saveEdit()">Guardar</button>
            <button class="bg-red-500 text-white py-2 px-4 rounded" onclick="document.getElementById('editCategoryModal').classList.add('hidden')">Cancelar</button>
        </div>
    </div>

    <script>
        function editCategory(id, nombre, descripcion) {
            document.getElementById('editId').value = id;
            document.getElementById('editNombre').value = nombre;
            document.getElementById('editDescripcion').value = descripcion;
            document.getElementById('editCategoryModal').classList.remove('hidden');
        }

        function saveEdit() {
            const id = document.getElementById('editId').value;
            const nombre = document.getElementById('editNombre').value;
            const descripcion = document.getElementById('editDescripcion').value;

            // Llama a tu backend para guardar la edición
            fetch('../categorias/editar.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id, nombre, descripcion })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Recargar la página para ver los cambios
                } else {
                    alert('Error al guardar la categoría');
                }
            });
        }

        function deleteCategory(id) {
    const messageDiv = document.getElementById('message');

    // Limpiar el mensaje anterior
    messageDiv.textContent = '';

    // Verificar si la categoría está asociada a productos
    fetch(`../categorias/verificar.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.hasProducts) {
                messageDiv.textContent = 'No se puede eliminar esta categoría porque está asociada a uno o más productos.';
                return;
            }
            
            if (confirm('¿Estás seguro de que deseas eliminar esta categoría?')) {
                fetch('../categorias/eliminar.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Recargar la página para ver los cambios
                    } else {
                        messageDiv.textContent = 'Error al eliminar la categoría';
                    }
                });
            }
        })
        .catch(error => {
            console.error('Error en la verificación:', error);
            messageDiv.textContent = 'Ocurrió un error al verificar la categoría.';
        });
}

    </script>
</div>


    <!-- Add Category Modal -->
<div id="addCategoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg w-1/2">
        <h2 class="flex items-center justify-center space-x-4 bg-pink-200 mb-4">NUEVA CATEGORIA</h2>
        <form id="addCategoryForm" action="../categorias/agregar.php" method="POST">
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Ingrese el nombre de la categoria</label>
                <input type="text" name="nombre" id="nombre" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            
            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Ingrese la descripcion de la categoria</label>
                <input type="text" name="descripcion" id="descripcion" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            
            <div class="flex justify-left">
                <button type="button" class="bg-yellow-400 text-black font-bold py-2 px-4 rounded mr-2" onclick="document.getElementById('addCategoryModal').classList.add('hidden')">Cancelar</button>
                <button type="submit" class="bg-green-500 text-black font-bold py-2 px-4 rounded">Guardar</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>