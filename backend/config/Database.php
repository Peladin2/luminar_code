<?php

class Database
{
    public $conexion;

    public function __construct()
    {
        $host = 'localhost';
        $baseDatos = 'centro_educativo_db';
        $usuario = 'luminar_usuario';
        $clave = 'luminar_usuario12345';

        $dsn = 'mysql:host=' . $host . ';dbname=' . $baseDatos . ';charset=utf8mb4';

        try {
            $this->conexion = new PDO($dsn, $usuario, $clave);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error de conexion a la base de datos: ' . $e->getMessage());
        }
    }
}