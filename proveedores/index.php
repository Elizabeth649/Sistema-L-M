<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROVEEDORES</title>
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
            <a href="" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
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

    <div class="w-4/5 p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">PROVEEDORES</h1>
        </div>
        <button class="bg-green-500 text-white py-2 px-4 rounded mb-6" onclick="document.getElementById('addProviderModal').classList.remove('hidden')">
        <i class="fas fa-plus mr-2"></i> Nuevo Proveedor
        </button>


        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-pink-200 text-left">
                    <th class="py-2 px-4 border text-center">Id</th>
                    <th class="py-2 px-4 border text-center">Nombre de Empresa</th>
                    <th class="py-2 px-4 border text-center">Nombre de Encargado/a</th>
                    <th class="py-2 px-4 border text-center">Teléfono</th>
                    <th class="py-2 px-4 border text-center">Email</th>
                    <th class="py-2 px-4 border">Acción</th>
                </tr>
            </thead>
            <tbody id="providerTableBody">
                <?php
                $conn = new mysqli('localhost', 'root', '', 'inventario_lym');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT id, empresa, nombre, telefono, email FROM proveedores";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='border-b'>";
                        echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row["id"]) . "</td>";
                        echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row["empresa"]) . "</td>";
                        echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row["nombre"]) . "</td>";
                        echo "<td class='py-2 px-4 border text-center'> +503 " . htmlspecialchars($row["telefono"]) . "</td>";
                        echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row["email"]) . "</td>";
                        echo "<td class='py-2 px-4'>";
                        echo "<button class='bg-green-500 text-white py-1 px-3 rounded mr-2' onclick='editProvider(" . $row["id"] . ", \"" . addslashes($row["empresa"]) . "\", \"" . addslashes($row["nombre"]) . "\", \"" . addslashes($row["telefono"]) . "\", \"" . addslashes($row["email"]) . "\")'>Editar</button>";                       
                        echo "<button class='bg-red-500 text-white py-1 px-3 rounded' onclick='deleteProvider(" . $row["id"] . ")'>Eliminar</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='py-2 px-4'>No hay proveedores disponibles</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>


 <!-- Modal para editar proveedor -->
 <div id="editProviderModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center">
    <div class="bg-white p-6 rounded shadow-lg">
        <h2 class="flex items-center justify-center space-x-4 bg-pink-200 mb-4">Editar Proveedor</h2>
        <input type="hidden" id="editId">

        <label class="block mb-2">Nombre de empresa:</label>
        <input type="text" id="editEmpresa" class="border px-4 py-2 mb-4 w-full">

        <label class="block mb-2">Nombre de Encargado/a:</label>
        <input type="text" id="editNombre" class="border px-4 py-2 mb-4 w-full">

        <label class="block mb-2">Teléfono:</label>
        <input type="text" id="editTelefono" class="border px-4 py-2 mb-4 w-full">

        <label class="block mb-2">Email:</label>
        <input type="email" id="editEmail" class="border px-4 py-2 mb-4 w-full">

        <button class="bg-green-500 text-white py-2 px-4 rounded" onclick="saveEdit()">Guardar</button>
        <button type="button" class="bg-red-500 text-white py-2 px-4 rounded mr-2" onclick="cancelEdit()">Cancelar</button>
        
        </div>
</div>

<script>
    function editProvider(id, empresa, nombre, telefono, email) {
        document.getElementById('editId').value = id;
        document.getElementById('editEmpresa').value = empresa;
        document.getElementById('editNombre').value = nombre;
        document.getElementById('editTelefono').value = telefono;
        document.getElementById('editEmail').value = email;
        document.getElementById('editProviderModal').classList.remove('hidden');
    }

    function saveEdit() {
        const id = document.getElementById('editId').value;
        const empresa = document.getElementById('editEmpresa').value;
        const nombre = document.getElementById('editNombre').value;
        const telefono = document.getElementById('editTelefono').value;
        const email = document.getElementById('editEmail').value;


        // Llama a tu backend para guardar la edición
        fetch('../proveedores/editar.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id, empresa, nombre, telefono, email })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Recargar la página para ver los cambios
            } else {
                alert('Error al guardar el proveedor: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error en la conexión.');
        });
    }

    function deleteProvider(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este proveedor?')) {
        fetch('../proveedores/eliminar.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id }) // Asegúrate de que el ID se envía correctamente
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Recargar la página para ver los cambios
            } else {
                alert('Error al eliminar el proveedor: ' + (data.message || 'Error desconocido'));
            }
        })
        .catch(error => {
            console.error('Error en la eliminación:', error);
            alert('Ocurrió un error en la eliminación. Intenta de nuevo más tarde.');
        });
    }
        }function cancelEdit() {
            // Limpiar los campos del formulario
            document.getElementById('editEmpresa').value = '';
            document.getElementById('editNombre').value = '';
            document.getElementById('editTelefono').value = '';
            document.getElementById('editEmail').value = '';
            
            // Ocultar el modal
            document.getElementById('editProviderModal').classList.add('hidden');
        }

</script>

       
        <!-- Add Provider Modal -->
        <div id="addProviderModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg w-1/2">
                <h2 class="flex items-center justify-center space-x-4 bg-pink-200 mb-4">NUEVO PROVEEDOR</h2>
                <form method="POST" action="../proveedores/agregar.php">
                    <div class="mb-4">
                        <label for="empresa" class="block text-sm font-medium text-gray-700">Nombre de la Empresa:</label>
                        <input type="text" name="empresa" id="empresa" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del Encargado/a:</label>
                        <input type="text" name="nombre" id="nombre" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <div class="flex justify-left mt-4">
                        <button type="submit" class="bg-green-500 text-black font-bold py-2 px-4 rounded">Guardar</button>
                        <button type="button" class="bg-yellow-400 text-black font-bold py-2 px-4 rounded mr-2" onclick="document.getElementById('addProviderModal').classList.add('hidden')">Cancelar</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
