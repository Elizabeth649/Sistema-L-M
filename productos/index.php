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
            <a href="" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
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

    <div class="w-4/5 p-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">PRODUCTOS</h1>
            </div>
            <button class="bg-green-500 text-white py-2 px-4 rounded mb-6" onclick="document.getElementById('addProductModal').classList.remove('hidden')">
                <i class="fas fa-plus mr-2"></i> Nuevo Producto
            </button>

            <button class="bg-blue-500 text-white py-2 px-4 rounded" onclick="window.location.href='../productos/productos_existentes.php'">
                <i class="fas fa-box mr-2"></i> Existentes
            </button>

            <button class="bg-orange-500 text-white py-2 px-4 rounded" onclick="window.location.href='../productos/productos_vendidos.php'">
                <i class="fas fa-shopping-cart mr-2"></i> Vendidos
            </button>

            <!-- Buscador -->
            <div class="py-2 px-4 text-right">
                <input type="text" id="searchInput" placeholder="Buscar productos..." class="border px-4 py-2 w-1/3" style="color: black;" onkeyup="filterProducts()">
            </div>

            <!-- Tabla con la lista de los productos registrados -->
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-pink-200 text-left">
                        <th class="py-2 px-4 border">Id</th>
                        <th class="py-2 px-4 border">Nombre</th>
                        <th class="py-2 px-4 border">Descripción</th>
                        <th class="py-2 px-4 border">Cantidad</th>
                        <th class="py-2 px-4 border">Unidad de Medida</th>
                        <th class="py-2 px-4 border">Categoría</th>
                        <th class="py-2 px-4 border">Precio por Unidad (adquirido)</th>
                        <th class="py-2 px-4 border">Precio por Mayoreo (adquirido)</th>
                        <th class="py-2 px-4 border">Precio por Unidad LyM</th>
                        <th class="py-2 px-4 border">Precio por Mayoreo LyM</th>
                        <th class="py-2 px-4 border">Fecha de Vencimiento</th>
                        <th class="py-2 px-4 border">Acción</th>
                    </tr>
                </thead>
                <tbody id="productTableBody">
                    <?php
                    $conn = new mysqli('localhost', 'root', '', 'inventario_lym');

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT p.id, p.nombre, p.descripcion, p.cantidad, p.unidad_medida, c.nombre AS categoria, p.precio_unidad, p.precio_mayoreoad, p.precio_unidadlym, p.precio_mayoreolym, p.fecha_vencimiento 
                            FROM productos p 
                            JOIN categorias c ON p.categoria_id = c.id";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='border-b'>";
                            echo "<td class='py-2 px-4 border'>" . htmlspecialchars($row["id"]) . "</td>";
                            echo "<td class='py-2 px-4 border'>" . htmlspecialchars($row["nombre"]) . "</td>";
                            echo "<td class='py-2 px-4 border'>" . htmlspecialchars($row["descripcion"]) . "</td>";
                            echo "<td class='py-2 px-4 border'>" . htmlspecialchars($row["cantidad"]) . "</td>";
                            echo "<td class='py-2 px-4 border'>" . htmlspecialchars($row["unidad_medida"]) . "</td>"; 
                            echo "<td class='py-2 px-4 border'>" . htmlspecialchars($row["categoria"]) . "</td>";
                            echo "<td class='py-2 px-4 border'>$" . htmlspecialchars($row["precio_unidad"]) . "</td>";
                            echo "<td class='py-2 px-4 border'>$" . htmlspecialchars($row["precio_mayoreoad"]) . "</td>";
                            echo "<td class='py-2 px-4 border'>$" . htmlspecialchars($row["precio_unidadlym"]) . "</td>";
                            echo "<td class='py-2 px-4 border'>$" . htmlspecialchars($row["precio_mayoreolym"]) . "</td>";
                            echo "<td class='py-2 px-4 border'>" . htmlspecialchars($row["fecha_vencimiento"]) . "</td>";
                            echo "<td class='py-2 px-4 border'>";

                            // Botón para editar
                            echo "<button class='bg-green-500 text-white py-1 px-3 rounded mr-2' onclick='editProduct(" . $row["id"] . ", \"" . addslashes($row["nombre"]) . "\", \"" . addslashes($row["descripcion"]) . "\", " . $row["cantidad"] . ", \"" . $row["unidad_medida"] . "\", " . $row["precio_mayoreoad"] . ", " . $row["precio_unidadlym"] . ", " . $row["precio_mayoreolym"] . ", \"" . htmlspecialchars($row["fecha_vencimiento"]) . "\")'>Editar</button>";

                            echo "<button class='bg-red-500 text-white py-1 px-2 rounded' onclick=\"deleteProduct(" . htmlspecialchars($row["id"]) . ")\">Eliminar</button>";
                            // Botón para enviar a liquidación
                            echo "<button class='bg-yellow-500 text-white py-1 px-3 rounded' onclick=\"window.location.href='nueva_liquidacion.php?id=" . $row['id'] . "'\">Enviar a Liquidación</button>";


                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11' class='py-2 px-4'>No hay productos disponibles</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
</table>

<!-- Funcion para el buscador -->

<script>
    function filterProducts() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const tableBody = document.getElementById('productTableBody');
        const rows = tableBody.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j]) {
                    const cellText = cells[j].textContent || cells[j].innerText;
                    if (cellText.toLowerCase().indexOf(input) > -1) {
                        found = true;
                        break;
                    }
                }
            }
            rows[i].style.display = found ? '' : 'none';
        }
    }


function mostrarVendidos() {
    fetch('../ventas/productos_vendidos.php')
        .then(response => response.json())
        .then(data => {
            let html = "<h2>Productos Vendidos</h2><ul>";
            data.forEach(producto => {
                html += `<li>${producto.nombre} - Cantidad vendida: ${producto.cantidad}</li>`;
            });
            html += "</ul>";
            document.getElementById('listaProductos').innerHTML = html;
        })
        .catch(error => console.error('Error al obtener productos vendidos:', error));
}

   
</script>

<!-- Modal para editar producto -->
<div id="editProductModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center">
    <div class="bg-white p-6 rounded shadow-lg w-3/4">
        <h2 class="flex items-center justify-center space-x-4 bg-pink-200 mb-4">Editar Producto</h2>
        
        <input type="hidden" id="editId">
        
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block mb-2">Nombre del producto:</label>
                <input type="text" id="editNombre" class="border px-4 py-2 w-full">
            </div>
            <div>
                <label class="block mb-2">Descripción del producto:</label>
                <input type="text" id="editDescripcion" class="border px-4 py-2 w-full">
            </div>
            <div>
                <label class="block mb-2">Cantidad:</label>
                <input type="number" id="editCantidad" class="border px-4 py-2 w-full">
            </div>
            <div>
                <label class="block mb-2">Unidad de Medida:</label>
                <select id="editUnidadMedida" class="border px-4 py-2 w-full">
    <option value="Unidad">Unidad</option>
    <option value="Yarda">Yarda</option>
    <option value=" Centimetros">Centimetros</option>

    
</select> 

            </div>
            <div>
                <label class="block mb-2">Precio por Unidad(adquirido):</label>
                <input type="number" id="editPrecioUnidad" class="border px-4 py-2 w-full">
            </div>
            <div>
                <label class="block mb-2">Precio por Mayoreo(adquirido):</label>
                <input type="number" id="editPrecioMayoreoad" class="border px-4 py-2 w-full">
            </div>
            <div>
                <label class="block mb-2">Precio por Unidad LyM:</label>
                <input type="number" id="editPrecioUnidadLyM" class="border px-4 py-2 w-full">
            </div>
            <div>
                <label class="block mb-2">Precio por Mayoreo LyM:</label>
                <input type="number" id="editPrecioMayoreoLyM" class="border px-4 py-2 w-full">
            </div>
            <div>
                <label class="block mb-2">Fecha de Vencimiento:</label>
                <input type="date" id="editFechaVencimiento" class="border px-4 py-2 w-full">
            </div>
        </div>

        <div class="flex justify-start space-x-4">
            <button class="bg-green-500 text-white py-2 px-4 rounded" onclick="saveEdit()">Guardar</button>
            <button class="bg-red-500 text-white py-2 px-4 rounded" onclick="document.getElementById('editProductModal').classList.add('hidden')">Cancelar</button>
        </div>
    </div>
</div>

<script>
    function filterProducts() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('#productTableBody tr');
        
        rows.forEach(row => {
            const cells = row.getElementsByTagName('td');
            let match = false;
            for (let cell of cells) {
                if (cell.innerText.toLowerCase().includes(input)) {
                    match = true;
                    break;
                }
            }
            row.style.display = match ? '' : 'none';
        });
    }

    function editProduct(id, nombre, descripcion, cantidad, unidadMedida, precio_unidad, precio_mayoreoad, precio_unidadlym, precio_mayoreolym, fecha_vencimiento) {
        document.getElementById('editId').value = id;
        document.getElementById('editNombre').value = nombre;
        document.getElementById('editDescripcion').value = descripcion;
        document.getElementById('editCantidad').value = cantidad;
        document.getElementById('editUnidadMedida').value = unidadMedida;
        document.getElementById('editPrecioUnidad').value = precio_unidad;
        document.getElementById('editPrecioMayoreoad').value = precio_mayoreoad;
        document.getElementById('editPrecioUnidadLyM').value = precio_unidadlym;
        document.getElementById('editPrecioMayoreoLyM').value = precio_mayoreolym;
        document.getElementById('editFechaVencimiento').value = fecha_vencimiento;

        document.getElementById('editProductModal').classList.remove('hidden');
    }

    function saveEdit() {
        const id = document.getElementById('editId').value;
        const nombre = document.getElementById('editNombre').value;
        const descripcion = document.getElementById('editDescripcion').value;
        const cantidad = document.getElementById('editCantidad').value;
        const unidadMedida = document.getElementById('editUnidadMedida').value;
        const precio_unidad = document.getElementById('editPrecioUnidad').value;
        const precio_mayoreoad = document.getElementById('editPrecioMayoreoad').value;
        const precio_unidadlym = document.getElementById('editPrecioUnidadLyM').value;
        const precio_mayoreolym = document.getElementById('editPrecioMayoreoLyM').value;
        const fecha_vencimiento = document.getElementById('editFechaVencimiento').value;

        fetch('../productos/editar.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id, nombre, descripcion, cantidad, unidadMedida, precio_unidad, precio_mayoreoad, precio_unidadlym, precio_mayoreolym, fecha_vencimiento })
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
            alert('Error de conexión. Inténtalo de nuevo.');
        });
    }

    function deleteProduct(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
        fetch('../productos/eliminar.php', {
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
                alert('Error al eliminar el producto: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error de conexión. Inténtalo de nuevo.');
        });
    }
}

</script>



<script>
        // Función para filtrar productos en la tabla
        function filterProducts() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const tableBody = document.getElementById('productTableBody');
            const rows = tableBody.getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < cells.length; j++) {
                    if (cells[j]) {
                        const cellText = cells[j].textContent || cells[j].innerText;
                        if (cellText.toLowerCase().indexOf(input) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                rows[i].style.display = found ? '' : 'none';
            }
        }
    </script>
</div>


    <!-- Add Product Modal -->
    <div id="addProductModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg w-1/2">
            <h2 class="flex items-center justify-center space-x-4 bg-pink-200 mb-4">NUEVO PRODUCTO</h2>
            <form method="POST" action="../productos/agregar.php"> <!-- Cambia el action al script de guardar -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Ingrese el nombre del producto</label>
                        <input type="text" name="nombre" id="nombre" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Ingrese la descripción del producto</label>
                        <input type="text" name="descripcion" id="descripcion" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="cantidad" class="block text-sm font-medium text-gray-700">Ingrese la cantidad del producto</label>
                        <input type="number" name="cantidad" id="cantidad" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                    <label for="unidad_medida" class="block text-sm font-medium text-gray-700">Seleccione la unidad de medida</label>
                    <select name="unidad_medida" id="unidad_medida" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="">Seleccione una unidad de medida</option>
                        <option value="unidad">Unidad</option>
                        <option value="yardas">Yardas</option>
                        <option value="centimetros">Centimetros</option>
                    </select>
                    </div>

                    <div class="mb-4">
                        <label for="categoria" class="block text-sm font-medium text-gray-700">Seleccione la categoria del producto</label>
                        <select name="categoria" id="categoria" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="">Seleccione una categoría</option>
                            <?php
                            $conn = new mysqli('localhost', 'root', '', 'inventario_lym');
                            if ($conn->connect_error) {
                                die("Conexión fallida: " . $conn->connect_error);
                            }
                            $sql = "SELECT id, nombre FROM categorias";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
                                }
                            } else {
                                echo '<option value="">No hay categorías disponibles</option>';
                            }
                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <div class="mb-4">
    <label for="fecha_vencimiento" class="block text-sm font-medium text-gray-700">Fecha de Vencimiento</label>
    <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
</div>

                <div class="mb-4">
                <label for="precio_unidad" class="block text-sm font-medium text-gray-700">Ingrese el precio del producto por unidad (adquirido)</label>
                <div class="input-group">
                    <input type="number" name="precio_unidad" id="precio_unidad" step="any" min="0" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
            </div>
            <div class="mb-4">
                <label for="precio_mayoreoad" class="block text-sm font-medium text-gray-700"> Ingrese el precio del producto por mayoreo (adquirido)</label>
              <div class="input-group">
                    <input type="number" name="precio_mayoreoad" id="precio_mayoreoad" step="any" min="0" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
            </div>
            <div class="mb-4">
                <label for="precio_unidadlym" class="block text-sm font-medium text-gray-700"> Ingrese el precio del producto por unidad (LyM)                </label>
                <div class="input-group">
                    <input type="number" name="precio_unidadlym" id="precio_unidadlym" step="any" min="0" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
            </div>
            <div class="mb-4">
                <label for="precio_mayoreolym" class="block text-sm font-medium text-gray-700">Ingrese el precio del producto por mayoreo (LyM)                </label>
                <div class="input-group">
                    <input type="number" name="precio_mayoreolym" id="precio_mayoreolym" step="any" min="0" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
            </div>
            </div>
                <div class="flex justify-left mt-4">
                    <button type="button" class="bg-yellow-400 text-black font-bold py-2 px-4 rounded mr-2" onclick="document.getElementById('addProductModal').classList.add('hidden')">Cancelar</button>
                    <button type="submit" class="bg-green-500 text-black font-bold py-2 px-4 rounded">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
