<?php
// esto va arriba de cada pagina
// antes se puede poner $titulo y $ruta

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($ruta)) {
    $ruta = '';
}

if (!isset($titulo)) {
    $titulo = 'Escuela Técnica N.º 1 Bella Unión';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $titulo; ?></title>
    <link rel="icon" href="<?php echo $ruta; ?>assets/iconos/favicon.png">

    <!-- bootstrap e iconos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- fuente -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

    <link href="<?php echo $ruta; ?>assets/css/estilos.css" rel="stylesheet">
</head>
<body>