<?php
/*2. Realizar una consulta a la base de datos y mostrar los primeros 5 film
con su informacion en una CARD de bootstrap. Valor 10% */

require_once 'ConexionBD.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $consulta = "SELECT * FROM film LIMIT 5";
    $stmt = $conn->query($consulta);
    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    echo ('Error en la conexion a Sakila: ' . $e->getMessage());
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejercicio 2</title>
</head>
<body>
<div class="container">
    <h1>EJERCICIO 2 - PELICULAS </h1>
    <div class="card">
        <?php foreach ($films as $film) : ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Titulo: <?php echo ($film['title']); ?></p>
                        <p class="card-text">Descripción: <?php echo ($film['description']); ?> </p>
                        <p class="card-text"> Año de lanzamiento:<?php echo ($film['release_year']); ?> </p>
                        <p class="card-text"> Características especiales:<?php echo ($film['special_features']);?>  <br><br> </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>