<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUCTOS</title>
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
            <a href="../usuarios/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
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

    <body class="bg-pink-100 flex justify-center items-center min-h-screen">
    <div class="w-4/5 p-8">
        <h1 class="text-2xl font-bold mb-6">LISTA DE PRODUCTOS EN LIQUIDACIÓN</h1>
        <button class="bg-green-500 text-white py-2 px-4 rounded mb-6" onclick="document.getElementById('addProductModal').classList.remove('hidden')">
            <i class="fas fa-plus mr-2"></i> Nueva Liquidacion
        </button>
        
        <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-pink-200 text-left">
                        <th class="py-2 px-4 border text-center">Id</th>
                        <th class="py-2 px-4 border text-center">Nombre</th>
                        <th class="py-2 px-4 border text-center">Descripción</th>
                        <th class="py-2 px-4 border text-center">Cantidad</th>
                        <th class="py-2 px-4 border text-center">Estado</th>
                        <th class="py-2 px-4 border text-center">Costo</th>
                        <th class="py-2 px-4 ">Acción</th>
                    </tr>
                </thead>
                <tbody id="productTableBody">
                    <?php
                    $conn = new mysqli('localhost', 'root', '', 'inventario_lym');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM liquidacion";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='border-b'>";
                            echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row["id"]) . "</td>";
                            echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row["nombre"]) . "</td>";
                            echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row["descripcion"]) . "</td>";
                            echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row["cantidad"]) . "</td>";
                            echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row["estado"]) . "</td>";
                            echo "<td class='py-2 px-4 border text-center'>$" . htmlspecialchars($row["costo"]) . "</td>";
                            echo "<td class='py-2 px-4'>"
                                . "<button class='bg-green-500 text-white py-1 px-3 rounded mr-2' onclick='editProduct(" . $row["id"] . ", \"" . addslashes($row["nombre"]) . "\", \"" . addslashes($row["descripcion"]) . "\", " . $row["costo"] . ", " . $row["cantidad"] . ")'>Editar</button>"
                                . "<button class='bg-red-500 text-white py-1 px-3 rounded' onclick='deleteProduct(" . $row["id"] . ")'>Eliminar</button>"
                                . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='py-2 px-4'>No hay productos en liquidación</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
    </div>
        
 <!-- Modal para editar producto -->
<div id="editProductModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg w-3/4">
        <h2 class="flex items-center justify-center space-x-4 bg-pink-200 mb-4">EDITAR PRODUCTO EN LIQUIDACION</h2>
        <form class="grid grid-cols-2 gap-4" id="editProductForm" method="POST" action="">
            <input type="hidden" name="id" id="productId">
            <div>
                <label class="block mb-2">Nombre:</label>
                <input type="text" name="nombre" id="productName" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block mb-2">Estado:</label>
                <select name="estado" id="productStatus" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="Nuevo">Nuevo</option>
                    <option value="Descartado">Descartado</option>
                    <option value="De Temporada">De Temporada</option>

                </select>
            </div>
            <div>
                <label class="block mb-2">Descripción:</label>
                <input type="text" name="descripcion" id="productDescription" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block mb-2">Costo:</label>
                <input type="number" step="0.01" name="costo" id="productCost" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block mb-2">Cantidad:</label>
                <input type="number" name="cantidad" id="productQuantity" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="flex items-end justify-start space-x-4 col-span-2">
                <button type="button" class="bg-red-500 text-white py-2 px-4 rounded" onclick="closeEditModal()">Cancelar</button>
                <button type="button" class="bg-green-500 text-white py-2 px-4 rounded" onclick="saveEdit()">Guardar</button>
            </div>
        </form>
    </div>
</div>

    <script>
        function openAddProductModal() {
            document.getElementById('addProductModal').classList.remove('hidden');
        }

        function closeAddProductModal() {
            document.getElementById('addProductModal').classList.add('hidden');
        }

        function editProduct(id, nombre, descripcion, costo, cantidad) {
            document.getElementById('productId').value = id;
            document.getElementById('productName').value = nombre;
            document.getElementById('productDescription').value = descripcion;
            document.getElementById('productCost').value = costo;
            document.getElementById('productQuantity').value = cantidad;
            document.getElementById('editProductModal').classList.remove('hidden'); // Mostrar modal
        }

        function closeEditModal() {
            document.getElementById('editProductModal').classList.add('hidden'); // Cerrar modal
        }

        function saveEdit() {
                const id = document.getElementById('productId').value;
                const nombre = document.getElementById('productName').value;
                const estado = document.getElementById('productStatus').value; // Recuperar valor del estado
                const descripcion = document.getElementById('productDescription').value;
                const costo = document.getElementById('productCost').value;
                const cantidad = document.getElementById('productQuantity').value;

                fetch('../liquidacion/editar.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id, nombre, estado, descripcion, costo, cantidad }) // Incluir el estado en el body
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Recargar la página para ver los cambios
                    } else {
                        alert('Error al guardar el producto');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Hubo un error al procesar la solicitud');
                });
            }


        function deleteProduct(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                fetch('../liquidacion/eliminar.php', {
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
                        alert('Error al eliminar el producto');
                    }
                });
            }
        }
    </script>

    <!-- Modal para agregar producto -->
 <div id="addProductModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg w-3/4">
                <h2 class="flex items-center justify-center space-x-4 bg-pink-200 mb-4">NUEVO PRODUCTO EN LIQUIDACION</h2>
                <form class="grid grid-cols-2 gap-4" method="POST" action="../liquidacion/agregar.php">
                    <div>
                        <label class="block mb-2">Ingrese el nombre del producto en liquidación</label>
                        <input type="text" name="nombre" class="w-full p-2 border border-gray-300 rounded bg-purple-100" required>
                    </div>
                    <div>
                        <label class="block mb-2">Seleccione el estado del producto</label>
                        <select name="estado" class="w-full p-2 border border-gray-300 rounded bg-purple-100" required>
                            <option value="">Seleccione</option>
                            <option value="Nuevo">Nuevo</option>
                            <option value="Descartado">Descartado</option>
                            <option value="De Temporada">De Temporada</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2">Ingrese la descripción del producto en liquidación</label>
                        <input type="text" name="descripcion" class="w-full p-2 border border-gray-300 rounded bg-purple-100" required>
                    </div>
                    <div>
                        <label class="block mb-2">Ingrese el costo del producto</label>
                        <input type="number" step="0.01" name="costo" class="w-full p-2 border border-gray-300 rounded bg-purple-100" required>
                    </div>
                    <div>
                        <label class="block mb-2">Ingrese la cantidad de productos</label>
                        <input type="number" name="cantidad" class="w-full p-2 border border-gray-300 rounded bg-purple-100" required>
                    </div>
                    <div class="flex items-end justify-start space-x-4 col-span-2">
                        <button type="button" class="bg-yellow-400 text-black font-bold py-2 px-4 rounded" onclick="closeAddProductModal()">Cancelar</button>
                        <button type="submit" class="bg-green-500 text-black font-bold py-2 px-4 rounded">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>