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
        <h1 class="text-center text-2xl font-semibold">LIBRERIA Y VARIEDADES LyM</h1>
        <i class="fas fa-user-circle text-2xl"></i>
    </div>
<body class="bg-pink-100">
    <div class="flex">
        <!-- Sidebar -->
        <body class="bg-pink-100">
    <div class="flex">
        <div class="flex flex-col space-y-4 p-4">
            <a href="inicio.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
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
            <a href="ajustes.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
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
        <h1 class="text-2xl font-bold">PRODUCTOS VENDIDOS</h1>
        </div>
        <button class="bg-green-500 text-white py-2 px-4 rounded mb-6" onclick="window.location.href='../productos/index.php'">
            <i class="fas fa-list mr-2"></i> Volver a la Lista de Productos
        </button>

        <button class="bg-blue-500 text-white py-2 px-4 rounded" onclick="window.location.href='../productos/productos_existentes.php'">
            <i class="fas fa-box mr-2"></i> Existentes
        </button>

        <button class="bg-orange-500 text-white py-2 px-4 rounded" onclick="window.location.href='../productos/productos_vendidos.php'">
            <i class="fas fa-shopping-cart mr-2"></i> Vendidos
        </button>

         <!-- Buscador -->
         <tr class="bg-white-200 text-left">
            <th colspan="8" class="py-2 px-4 text-right">
                <input type="text" id="searchInput" placeholder="Buscar productos..." class="border px-4 py-2 w-1/3" style="float: right; color: black;" onkeyup="filterProducts()">
            </th>
        </tr>

        <div id="listaProductos"></div>

    <table class="min-w-full bg-white">
        <thead>
        <tr class="bg-pink-200 text-left">
            <th class="py-2 px-4 border text-center">Id</th>
            <th class="py-2 px-4 border text-center">Nombre</th>
            <th class="py-2 px-4 border text-center">Descripción</th>
            <th class="py-2 px-4 border text-center">Cantidad Vendida</th>
            <th class="py-2 px-4 border text-center">Categoría</th>
            <th class="py-2 px-4 border text-center">Precio por Unidad (LyM)</th>
            <th class="py-2 px-4 border text-center">Precio por Mayoreo (Lym)</th>
            <th class="py-2 px-4 border text-center">Fecha de Vencimiento</th> <!-- Nueva columna -->
        </tr>
        </thead>
        <tbody id="productTableBody">
            <?php
            // Conexión a la base de datos
            $conn = new mysqli('localhost', 'root', '', 'inventario_lym');
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Consulta para mostrar la cantidad vendida de productos
            $sql = "SELECT p.id, p.nombre, p.descripcion, 
                           IFNULL(SUM(v.cantidad), 0) AS cantidad_vendida, 
                           c.nombre AS categoria, p.precio_unidadlym, p.precio_mayoreolym,  p.fecha_vencimiento
                    FROM productos p
                    LEFT JOIN ventas v ON p.id = v.productos_id
                    JOIN categorias c ON p.categoria_id = c.id
                    WHERE v.cantidad IS NOT NULL  -- Solo mostrar productos con ventas
                    GROUP BY p.id, p.nombre, p.descripcion, c.nombre, p.precio_unidadlym, p.precio_mayoreolym, p.fecha_vencimiento";

            $result = $conn->query($sql);

            // Mostrar los productos vendidos
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='border-b'>";
                    echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row["id"]) . "</td>";
                    echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row["nombre"]) . "</td>";
                    echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row["descripcion"]) . "</td>";
                    echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row["cantidad_vendida"]) . "</td>";
                    echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row["categoria"]) . "</td>";
                    echo "<td class='py-2 px-4 border text-center'>$" . htmlspecialchars($row["precio_unidadlym"]) . "</td>";
                    echo "<td class='py-2 px-4 border text-center'>$" . htmlspecialchars($row["precio_mayoreolym"] ?? 'N/A') . "</td>";
                    echo "<td class='py-2 px-4 border text-center'>" . htmlspecialchars($row["fecha_vencimiento"] ?? 'N/A') . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='py-2 px-4'>No hay productos vendidos</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <!-- Función para el buscador -->
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
    </script>
</div>
