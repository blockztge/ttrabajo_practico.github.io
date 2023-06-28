
<link rel="stylesheet" type="text/css" href="estilos.css">

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // se obtienen los datos del formulario
        $nombre = $_POST['nombre'];
        $codigo = $_POST['codigo'];
        $descripcion = $_POST['descripcion'];
        $precio = floatval($_POST['precio']);
        $cantidad = intval($_POST['cantidad']);
        $impuesto = floatval($_POST['impuesto']);

        // En esta linea se valida y se procesan los datos
        if (!empty($nombre) && !empty($codigo) && !empty($descripcion) && $precio >= 0 && $impuesto >= 0 && $cantidad >= 1) {
            // se calcula el precio neto
            $precio_neto = $precio * $cantidad;

            // se calculan los impuestos
            $impuestos = $precio_neto * ($impuesto / 100);

            // se calcula el total
            $total = $precio_neto + $impuestos;

            // se obtiene la informacion de la imagen
            $imagen = $_FILES['imagen'];
            $imagen_nombre = $imagen['name'];
            $imagen_tipo = $imagen['type'];
            $imagen_temp = $imagen['tmp_name'];
            $imagen_tamano = $imagen['size'];

            // se mueva la imagen a una ubicacion especifica
            $destino = 'img' . $imagen_nombre;
            move_uploaded_file($imagen_temp, $destino);

            // se muestran los resultados en una tabla
            echo "<table class='tabla-form'>";
            echo "<tr><th>Nombre del producto:</th><td>" . htmlspecialchars($nombre) . "</td></tr>";
            echo "<tr><th>Código del producto:</th><td>" . htmlspecialchars($codigo) . "</td></tr>";
            echo "<tr><th>Descripción:</th><td>" . htmlspecialchars($descripcion) . "</td></tr>";
            echo "<tr><th>Cantidad:</th><td>" . $cantidad . "</td></tr>";
            echo "<tr><th>Precio neto:</th><td>$" . number_format($precio_neto, 2) . "</td></tr>";
            echo "<tr><th>Impuestos:</th><td>$" . number_format($impuestos, 2) . "</td></tr>";
            echo "<tr><th>Total:</th><td>$" . number_format($total, 2) . "</td></tr>";
            echo "<tr><th class='img-tabla'>Imagen:</th><td>" ;
            echo "<img src='" . $destino . "' alt='Imagen del producto'>";
            echo "</table>";
        } else {
            echo "<p>Por favor, completa todos los campos correctamente.</p>";
        }
    }
    echo"<p>By Gustavo Montenegro</p>";
    ?>