<?php
/* 1. Permitir que a través de un formulario (Form) mostrado en el navegador se pueda crear
nuevos registros de Categoría (category), y en una tabla de Bootstrap mostrar los últimos
5 registros más actuales en la misma tabla (Category). (Todo esto en una misma página
del navegador, ejemplo primero mostrar el formulario y abajo de eso mostrar la tabla con
los 5 registros actuales) VALOR 15% */

require_once 'ConexionBD.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];

        if ($name) {
            $sql = "INSERT INTO category (name, last_update) VALUES (:name, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->execute(["name" => $name]);
            echo "Categoría agregada correctamente.";
        }
        else {
            echo "Debe ingresar un nombre válido.";
        }
    }

    $stmt = $conn->query("SELECT name, last_update 
                                 FROM category 
                                 ORDER BY last_update DESC 
                                 LIMIT 5");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Error en la conexión: " . $e->getMessage();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejercicio 1 Examen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>FORMULARIO INSERCIÓN DE DATOS</h1>
    <form method="post" action="" class="needs-validation" novalidate>
        <div class="mb-3">
            <label class="form-label fw-bold">Nombre Categoría de Película: </label>
            <input type="text" name="name" class="form-control" required>
            <div class="invalid-feedback">Ingrese el nombre de la categoría.</div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">REGISTRAR</button>
        </div>
    </form>

    <h1 class="mt-4">Últimas 5 Categorías Registradas</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Última Actualización</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $ct) : ?>
                <tr>
                    <td><?php echo $ct['name']; ?></td>
                    <td><?php echo $ct['last_update']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>