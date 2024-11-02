<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USUARIOS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-pink-100">


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
            <a href="../categorias/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
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
            <a href="" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-user"></i>
                <span>USUARIOS</span>
            </a>
            <a href="../ajustes/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-cog"></i>
                <span>AJUSTES</span>
            </a>
            <a href="../logout.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <span>CERRAR SESION</span>
            </a>
        </div>
    </div>


        <div class="w-4/5 p-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">USUARIOS DEL SISTEMA</h1>
            </div>

            <!-- Botón para añadir nuevo usuario -->
            <button class="bg-green-500 text-white py-2 px-4 rounded mb-6" onclick="document.getElementById('addUserModal').classList.remove('hidden')">
                <i class="fas fa-plus mr-2"></i> Nuevo Usuario
            </button>

            <!-- Tabla de usuarios -->
            <table class="min-w-full bg-white">
                <thead>
                <tr class="bg-pink-200 text-left">
                        <th class="py-2 px-4 border text-center">Id</th>
                        <th class="py-2 px-4 border text-center">Nombre</th>
                        <th class="py-2 px-4 border text-center">Correo</th>
                        <th class="py-2 px-4 border text-center">Acción</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    <?php
                    $conn = new mysqli('localhost', 'root', '', 'inventario_lym');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT id, nombre, correo FROM usuarios";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='border-b'>";
                            echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row["id"]) . "</td>";
                            echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row["nombre"]) . "</td>";
                            echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row["correo"]) . "</td>";
                            echo "<td class='py-2 px-4'>";
                            echo "<button class='bg-green-500 text-white py-1 px-3 rounded mr-2' onclick='editUser(" . $row["id"] . ", \"" . addslashes($row["nombre"]) . "\", \"" . addslashes($row["correo"]) . "\")'>Editar</button>";
                            echo "<button class='bg-red-500 text-white py-1 px-3 rounded' onclick='deleteUser(" . $row["id"] . ")'>Eliminar</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='py-2 px-4'>No hay usuarios disponibles</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Modal para editar usuario -->
<div id="editUserModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg w-1/2">
        <h2 class="flex items-center justify-center space-x-4 bg-pink-200 mb-4">EDITAR USUARIO</h2>
        <form method="POST" action="../usuarios/editar.php">
            <!-- Campo oculto para el ID del usuario -->
            <input type="hidden" name="id" id="editUserId">

            <div class="mb-4">
                <label for="editNombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                <input type="text" name="nombre" id="editNombre" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3" required>
            </div>
            <div class="mb-4">
                <label for="editCorreo" class="block text-sm font-medium text-gray-700">Correo:</label>
                <input type="email" name="correo" id="editCorreo" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3" required>
            </div>
            <div class="mb-4">
                <label for="editContraseña" class="block text-sm font-medium text-gray-700">Nueva Contraseña (opcional):</label>
                <input type="password" name="contraseña" id="editContraseña" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
            </div>

            <div class="flex justify-left mt-4">
                <button type="submit" class="bg-green-500 text-black font-bold py-2 px-4 rounded">Guardar Cambios</button>
                <button type="button" class="bg-yellow-400 text-black font-bold py-2 px-4 rounded mr-2" onclick="document.getElementById('editUserModal').classList.add('hidden')">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
    window.onload = function() {
        // Alertas si existen
        <?php
        if (isset($_GET['agregado'])) {
            echo "alert('Usuario agregado exitosamente.');";
        }
        if (isset($_GET['editado'])) {
            echo "alert('Usuario editado exitosamente.');";
        }
        if (isset($_GET['eliminado'])) {
            echo "alert('Usuario eliminado exitosamente.');";
        }
        if (isset($_GET['error']) && $_GET['error'] == 'correo_existente') {
            echo "alert('El correo ya existe. Por favor, utiliza otro.');";
        }
        ?>
    };
</script>

<script>
    function editUser(id, nombre, correo) {
        // Rellenar los campos del modal con los datos del usuario seleccionado
        document.getElementById('editUserId').value = id;
        document.getElementById('editNombre').value = nombre;
        document.getElementById('editCorreo').value = correo;

        // Mostrar el modal de edición
        document.getElementById('editUserModal').classList.remove('hidden');
    }

    function deleteUser(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                fetch('../usuarios/eliminar.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error al eliminar el usuario: ' + (data.message || 'Error desconocido'));
                    }
                })
                .catch(error => {
                    console.error('Error en la eliminación:', error);
                    alert('Ocurrió un error en la eliminación. Intenta de nuevo más tarde.');
                });
            }
        }
</script>

        <!-- Modal para añadir nuevo usuario -->
        <div id="addUserModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg w-1/2">
                <h2 class="flex items-center justify-center space-x-4 bg-pink-200 mb-4">NUEVO USUARIO</h2>
                <form method="POST" action="../usuarios/agregar.php">
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3" required>
                    </div>
                    <div class="mb-4">
                        <label for="correo" class="block text-sm font-medium text-gray-700">Correo:</label>
                        <input type="email" name="correo" id="correo" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3" required>
                    </div>
                    <div class="mb-4">
                        <label for="contraseña" class="block text-sm font-medium text-gray-700">Contraseña:</label>
                        <input type="password" name="contraseña" id="contraseña" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3" required>
                    </div>

                    <div class="flex justify-left mt-4">
                        <button type="submit" class="bg-green-500 text-black font-bold py-2 px-4 rounded">Guardar</button>
                        <button type="button" class="bg-yellow-400 text-black font-bold py-2 px-4 rounded mr-2" onclick="document.getElementById('addUserModal').classList.add('hidden')">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
