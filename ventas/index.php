<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VENTAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-pink-100">


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
            <a href="" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
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

    <div class="container mx-auto p-4"> 
    <h1 class="text-left text-2xl font-bold mb-4">VENTAS</h1>
    <div class="flex justify-start mb-4">
        <button onclick="document.getElementById('addSaleModal').classList.remove('hidden')" class="bg-green-500 text-white px-4 py-2 rounded mr-2">
            <i class="fas fa-plus"></i> Nueva Venta
        </button>
        <button onclick="window.location.href='../ventas/generar_pdf.php'" class="bg-red-500 text-white px-4 py-2 rounded">
            Generar Pdf de ventas mensuales
        </button>

</div>

    
    <table class="min-w-full bg-white">
    <thead>
            <tr class="bg-pink-200">
                <th class="py-2 px-4 border">Id</th>
                <th class="py-2 px-4 border">Nombre</th>
                <th class="py-2 px-4 border">Descripción</th>
                <th class="py-2 px-4 border">Cantidad</th>
                <th class="py-2 px-4 border">Categoría</th>
                <th class="py-2 px-4 border">Precio Total Venta</th>
                <th class="py-2 px-4 border">Fecha de Venta</th>
                <th class="py-2 px-4 border">Acción</th>
            </tr>
        </thead>
        <?php
            // Conexión a la base de datos
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "inventario_lym";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta a la base de datos
            $sql = "SELECT ventas.id, productos.nombre AS productos_nombre, productos.descripcion, ventas.cantidad, 
            categorias.nombre AS categoria_nombre, ventas.precio_total, ventas.fecha 
            FROM ventas
            INNER JOIN productos ON ventas.productos_id = productos.id
            INNER JOIN categorias ON productos.categoria_id = categorias.id"; // Asegúrate de que el nombre del campo sea correcto

            $result = $conn->query($sql);

// Después de ejecutar la consulta
    if ($result && $result->num_rows > 0) {

                // Mostrar los datos en la tabla
                while($row = $result->fetch_assoc()) {
                    echo "<tr class='border-b'>";
                    echo "<td class='py-2 px-4 border text-center'>" . $row["id"] . "</td>";
                    echo "<td class='py-2 px-4 border text-center'>" . $row["productos_nombre"] . "</td>"; // Cambiado para usar el alias
                    echo "<td class='py-2 px-4 border text-center'>" . $row["descripcion"] . "</td>";
                    echo "<td class='py-2 px-4 border text-center'>" . $row["cantidad"] . "</td>";
                    echo "<td class='py-2 px-4 border text-center'>" . $row["categoria_nombre"] . "</td>"; // Cambiado para usar el alias
                    echo "<td class='py-2 px-4 border text-center'>" . $row["precio_total"] . "</td>";
                    echo "<td class='py-2 px-4 border text-center'>" . $row["fecha"] . "</td>";
                    echo "<td class='py-2 px-4'>";
                   
                    // Botón para editar
                    echo "<button class='bg-green-500 text-white py-1 px-3 rounded mr-2' onclick='editSale(" . $row["id"] . ", \"" . addslashes($row["productos_nombre"]) . "\", \"" . addslashes($row["descripcion"]) . "\", " . $row["cantidad"] . ", \"" . addslashes($row["categoria_nombre"]) . "\", " . $row["precio_total"] . ", \"" . $row["fecha"] . "\")'>Editar</button>";

                // Botón para eliminar
                echo "<button class='bg-red-500 text-white py-1 px-3 rounded' onclick='deleteVenta(" . $row["id"] . ")'>Eliminar</button>";

                    
                    echo "</td>";
                    echo "</tr>";
                }
                
                
            } else {
                echo "<tr><td colspan='8' class='py-2 px-4 border text-center'>No hay datos disponibles</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<!-- Mini Modal para ver detalles -->
<div id="saleDetailModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded p-4">
        <h2 class="text-lg font-bold mb-4">Detalles de la Venta</h2>
        <div id="saleDetailsContent"></div>
        <button class="bg-red-500 text-white px-4 py-2 rounded mt-4" onclick="document.getElementById('saleDetailModal').classList.add('hidden')">Cerrar</button>
    </div>
</div>

<script>
    function showSaleDetails(saleId) {
        // Aquí puedes hacer una consulta AJAX para obtener los detalles de la venta
        // Luego, llenar el contenido del modal
        document.getElementById('saleDetailsContent').innerHTML = "Detalles de la venta con ID: " + saleId; // Reemplaza esto con el contenido real
        document.getElementById('saleDetailModal').classList.remove('hidden'); // Mostrar el modal
    }
</script>


 <!-- Modal para agregar una nueva venta -->
<div id="addSaleModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-1/2">
        <h2 class="flex items-center justify-center space-x-4 bg-pink-200 mb-4">NUEVA VENTA</h2>
        <form method="POST" action="../ventas/agregar.php">
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="productos" class="block text-sm font-medium text-gray-700">Seleccione el producto</label>
                    <select name="productos_id" id="productos" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required onchange="actualizarPrecio()">
                        <?php
                        $conn = new mysqli('localhost', 'root', '', 'inventario_lym');
                        if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                        }
                        $sql = "SELECT id, nombre, precio_unidadlym FROM productos";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo '<option value="'.$row['id'].'" data-precio="'.$row['precio_unidadlym'].'">'.$row['nombre'].'</option>';
                            }
                        } else {
                            echo '<option value="">No hay productos disponibles</option>';
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="cantidad" class="block text-sm font-medium text-gray-700">Ingrese la cantidad vendida</label>
                    <input type="number" name="cantidad" id="cantidad" min="1" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3" oninput="calcularPrecio()">
                </div>
                <div class="mb-4">
                    <label for="precio_total" class="block text-sm font-medium text-gray-700">Precio total</label>
                    <input type="number" name="precio_total" id="precio_total" step="any" min="0" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3" readonly>
                </div>
                <div class="mb-4">
                    <label for="fecha" class="block text-sm font-medium text-gray-700">Seleccione la fecha de venta</label>
                    <input type="date" name="fecha" id="fecha" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                </div>
            </div>

            <div class="flex justify-left mt-4">
                <button type="button" class="bg-yellow-400 text-white py-2 px-4 rounded mr-2" onclick="document.getElementById('addSaleModal').classList.add('hidden')">Cancelar</button>
                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">Guardar</button>
            </div>
        </form>
    </div>
</div>



    <script>
    // Función para actualizar el precio por unidad al cambiar el producto
    function actualizarPrecio() {
        const selectProducto = document.getElementById('productos');
        const precioUnidad = selectProducto.options[selectProducto.selectedIndex].getAttribute('data-precio');
        document.getElementById('cantidad').value = 1;  // Por defecto, ponemos 1
        calcularPrecio();
    }

    // Función para calcular el precio total según la cantidad
    function calcularPrecio() {
        const selectProducto = document.getElementById('productos');
        const precioUnidad = parseFloat(selectProducto.options[selectProducto.selectedIndex].getAttribute('data-precio'));
        const cantidad = parseInt(document.getElementById('cantidad').value);
        const precioTotal = (precioUnidad * cantidad).toFixed(2);
        document.getElementById('precio_total').value = precioTotal;
    }
    </script>

<script>


    
//Eliminar ventas
function deleteVenta(id) {
    if (confirm('¿Estás seguro de que deseas eliminar esta venta?')) {
        fetch('../ventas/eliminar.php', {
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
                alert('Error al eliminar la venta');
            }
        });
    }
}
</script>

<!-- Modal para editar venta -->
<div id="editSaleModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg w-1/2">
        <h2 class="flex items-center justify-center space-x-4 bg-blue-200 mb-4">EDITAR VENTA</h2>
        <form id="editSaleForm">
            <input type="hidden" name="venta_id" id="venta_id"> 
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="edit_productos" class="block text-sm font-medium text-gray-700">Seleccione el producto</label>
                    <select name="productos_id" id="edit_productos" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required onchange="actualizarPrecioUnidad()">
                    <?php
                        $conn = new mysqli('localhost', 'root', '', 'inventario_lym');
                        if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                        }
                        $sql = "SELECT id, nombre, precio_unidadlym FROM productos";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo '<option value="'.$row['id'].'" data-precio="'.$row['precio_unidadlym'].'">'.$row['nombre'].'</option>';
                            }
                        } else {
                            echo '<option value="">No hay productos disponibles</option>';
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="edit_cantidad" class="block text-sm font-medium text-gray-700">Ingrese la cantidad vendida</label>
                    <input type="number" name="cantidad" id="edit_cantidad" min="1" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3" oninput="calcularPrecioTotal()">
                </div>
                <div class="mb-4">
                    <label for="edit_precio_total" class="block text-sm font-medium text-gray-700">Precio total</label>
                    <input type="number" name="precio_total" id="edit_precio_total" step="any" min="0" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3" readonly>
                </div>
                <div class="mb-4">
                    <label for="edit_fecha" class="block text-sm font-medium text-gray-700">Seleccione la fecha de venta</label>
                    <input type="date" name="fecha" id="edit_fecha" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                </div>
            </div>

            <div class="flex justify-left mt-4">
                <button type="button" class="bg-yellow-400 text-white py-2 px-4 rounded mr-2" onclick="cancelEditSale()">Cancelar</button>
                <!-- Cambiado el botón para llamar a saveEditSale() en lugar de enviar el formulario -->
                <button type="button" class="bg-blue-500 text-white py-2 px-4 rounded" onclick="saveEditSale()">Actualizar</button>
            </div>
        </form>
    </div>
</div>



<!-- Modal para editar venta -->
<div id="editSaleModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg w-1/2">
        <h2 class="flex items-center justify-center space-x-4 bg-blue-200 mb-4">EDITAR VENTA</h2>
        <form method="POST" action="../ventas/editar.php">
            <input type="hidden" name="venta_id" id="venta_id"> <!-- ID oculto para identificar la venta a editar -->
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="edit_productos" class="block text-sm font-medium text-gray-700">Seleccione el producto</label>
                    <select name="productos_id" id="edit_productos" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required onchange="actualizarPrecioUnidad()">
                        <!-- Aquí se llenarán las opciones desde la base de datos en el servidor -->
                        <?php
                        $conn = new mysqli('localhost', 'root', '', 'inventario_lym');
                        if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                        }
                        $sql = "SELECT id, nombre, precio_unidadlym FROM productos";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo '<option value="'.$row['id'].'" data-precio="'.$row['precio_unidadlym'].'">'.$row['nombre'].'</option>';
                            }
                        } else {
                            echo '<option value="">No hay productos disponibles</option>';
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="edit_cantidad" class="block text-sm font-medium text-gray-700">Ingrese la cantidad vendida</label>
                    <input type="number" name="cantidad" id="edit_cantidad" min="1" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3" oninput="calcularPrecioTotal()">
                </div>
                <div class="mb-4">
                    <label for="edit_precio_total" class="block text-sm font-medium text-gray-700">Precio total</label>
                    <input type="number" name="precio_total" id="edit_precio_total" step="any" min="0" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3" readonly>
                </div>
                <div class="mb-4">
                    <label for="edit_fecha" class="block text-sm font-medium text-gray-700">Seleccione la fecha de venta</label>
                    <input type="date" name="fecha" id="edit_fecha" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                </div>
            </div>

            <div class="flex justify-left mt-4">
                <button type="button" class="bg-yellow-400 text-white py-2 px-4 rounded mr-2" onclick="document.getElementById('editSaleModal').classList.add('hidden')">Cancelar</button>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function editSale(id, producto_id, descripcion, cantidad, categoria_nombre, precio_total, fecha) {
        // Asigna los valores de la venta a los campos del formulario de edición
        document.getElementById('venta_id').value = id;
        document.getElementById('edit_productos').value = producto_id;
        document.getElementById('edit_cantidad').value = cantidad;
        document.getElementById('edit_precio_total').value = precio_total;
        document.getElementById('edit_fecha').value = fecha;

        // Mostrar el modal de edición
        document.getElementById('editSaleModal').classList.remove('hidden');
    }

    function saveEditSale() {
        const id = document.getElementById('venta_id').value;
        const producto_id = document.getElementById('edit_productos').value;
        const cantidad = document.getElementById('edit_cantidad').value;
        const precio_total = document.getElementById('edit_precio_total').value;
        const fecha = document.getElementById('edit_fecha').value;

        // Llama a tu backend para guardar la edición de la venta
        fetch('../ventas/editar.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id, producto_id, cantidad, precio_total, fecha })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Recargar la página para ver los cambios
            } else {
                alert('Error al guardar la venta: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error en la conexión.');
        });
    }

    function cancelEditSale() {
        // Limpiar los campos del formulario de edición de ventas
        document.getElementById('venta_id').value = '';
        document.getElementById('edit_productos').value = '';
        document.getElementById('edit_cantidad').value = '';
        document.getElementById('edit_precio_total').value = '';
        document.getElementById('edit_fecha').value = '';

        // Ocultar el modal
        document.getElementById('editSaleModal').classList.add('hidden');
    }

    function actualizarPrecioUnidad() {
        // Actualiza el precio total cuando cambia el producto seleccionado
        calcularPrecioTotal();
    }

    function calcularPrecioTotal() {
        const cantidad = parseFloat(document.getElementById('edit_cantidad').value);
        const precioUnidad = parseFloat(document.getElementById('edit_productos').selectedOptions[0].dataset.precio);
        if (!isNaN(cantidad) && !isNaN(precioUnidad)) {
            document.getElementById('edit_precio_total').value = (cantidad * precioUnidad).toFixed(2);
        }
    }
</script>

 

</div>
</body>
</html>