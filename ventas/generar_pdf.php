<?php
require('../libs/fpdf.php');

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

// Consulta para obtener el nombre del negocio
$sql_nombre = "SELECT nombre_negocio FROM ajustes WHERE id = 1";
$result_nombre = $conn->query($sql_nombre);
$nombre_negocio = 'LIBRERIA Y VARIEDADES LyM'; // Valor por defecto

if ($result_nombre && $result_nombre->num_rows > 0) {
    $row_nombre = $result_nombre->fetch_assoc();
    $nombre_negocio = $row_nombre['nombre_negocio']; // Obtener el nombre del negocio
}

// Consulta a la base de datos, agrupando las ventas por mes y ordenándolas por fecha
$sql = "SELECT ventas.id, productos.nombre AS productos_nombre, productos.descripcion, ventas.cantidad, 
categorias.nombre AS categoria_nombre, ventas.precio_total, ventas.fecha 
FROM ventas
INNER JOIN productos ON ventas.productos_id = productos.id
INNER JOIN categorias ON productos.categoria_id = categorias.id
ORDER BY YEAR(ventas.fecha), MONTH(ventas.fecha), ventas.fecha"; // Ordenamos por año y mes

$result = $conn->query($sql);

// Crear una instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

// Título
$pdf->Cell(190, 10, $nombre_negocio, 0, 1, 'C'); // Usar el nombre del negocio

$pdf->Cell(190, 20, 'VENTAS MENSUALES', 0, 1, 'C');

$pdf->Ln(3);  // Espacio entre el título y la tabla

// Definir márgenes (izquierdo y derecho)
$margen_izquierdo = 4;
$margen_derecho = 30;
$ancho_total_tabla = 190 - ($margen_izquierdo + $margen_derecho);

// Variables para agrupar por mes
$mes_actual = '';
$meses = [
    '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', 
    '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto',
    '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
];

// Función para agregar una tabla
function agregarEncabezadosTabla($pdf, $margen_izquierdo) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(255, 182, 193); // Color de fondo rosado pálido
    $pdf->SetX($margen_izquierdo);  // Margen izquierdo
    $pdf->Cell(7, 10, 'ID', 1, 0, 'C', true);
    $pdf->Cell(35, 10, 'Producto', 1, 0, 'C', true);
    $pdf->Cell(60, 10, 'Descripcion', 1, 0, 'C', true);
    $pdf->Cell(20, 10, 'Cantidad', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Categoria', 1, 0, 'C', true);
    $pdf->Cell(20, 10, 'Total', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Fecha', 1, 1, 'C', true);
}

// Llenar la tabla con los datos de la base de datos
$pdf->SetFont('Arial', '', 10);  // Fuente normal para los datos
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Obtener el mes y año de la venta actual
        $fecha = explode('-', $row['fecha']);
        $anio = $fecha[0];
        $mes = $fecha[1];
        $nombre_mes = $meses[$mes] . ' ' . $anio;

        // Si el mes cambia, agregar un título y encabezados de tabla
        if ($mes_actual != $nombre_mes) {
            if ($mes_actual != '') {
                $pdf->Ln(10);  // Espacio entre las tablas
            }

            // Agregar el nombre del mes como título de la tabla
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(190, 10, 'Ventas de ' . $nombre_mes, 0, 1, 'C');
            $pdf->Ln(5);  // Espacio entre el título y la tabla

            // Agregar los encabezados de la tabla
            agregarEncabezadosTabla($pdf, $margen_izquierdo);

            // Actualizar el mes actual
            $mes_actual = $nombre_mes;
        }

        // Agregar la fila de datos
        $pdf->SetX($margen_izquierdo);  // Establecer el margen izquierdo en cada fila
        $pdf->Cell(7, 10, $row['id'], 1, 0, 'C');
        $pdf->Cell(35, 10, utf8_decode($row['productos_nombre']), 1, 0, 'C');
        $pdf->Cell(60, 10, utf8_decode($row['descripcion']), 1, 0, 'C');
        $pdf->Cell(20, 10, $row['cantidad'], 1, 0, 'C');
        $pdf->Cell(30, 10, utf8_decode($row['categoria_nombre']), 1, 0, 'C');
        $pdf->Cell(20, 10, '$' . number_format($row['precio_total'], 2), 1, 0, 'C');
        $pdf->Cell(30, 10, $row['fecha'], 1, 1, 'C');
    }
} else {
    $pdf->SetX($margen_izquierdo);
    $pdf->Cell($ancho_total_tabla, 10, 'No hay ventas disponibles', 1, 1, 'C');
}

// Cerrar la conexión
$conn->close();

// Mostrar el PDF en el navegador
$pdf->Output('I', 'ventas.pdf');  // 'I' para mostrar el PDF en el navegador
?>
