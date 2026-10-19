<?php

require_once __DIR__ . '/../config/Database.php';

class Preinscripcion
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conexion;
    }

    public function obtenerTodos()
    {
        $sql = 'SELECT ID_Preinscripcion, Fecha, Posicion_Lista, Curso_Anterior, ID_Usuario, ID_Oferta FROM Preinscripcion ORDER BY Fecha';
        $consulta = $this->conexion->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $sql = 'SELECT ID_Preinscripcion, Fecha, Posicion_Lista, Curso_Anterior, ID_Usuario, ID_Oferta FROM Preinscripcion WHERE ID_Preinscripcion = :id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return $resultado;
        } else {
            return null;
        }
    }

    public function obtenerPorUsuario($idUsuario)
    {
        $sql = 'SELECT ID_Preinscripcion, Fecha, Posicion_Lista, Curso_Anterior, ID_Oferta FROM Preinscripcion WHERE ID_Usuario = :idUsuario';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // RNE-1: un usuario no puede tener mas de 3 preinscripciones en total.
    private function contarPreinscripcionesDeUsuario($idUsuario)
    {
        $sql = 'SELECT COUNT(*) AS Total FROM Preinscripcion WHERE ID_Usuario = :idUsuario';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC)['Total'];
    }

    // RNE-2: un usuario no puede preinscribirse dos veces a la misma oferta.
    private function yaExistePreinscripcion($idUsuario, $idOferta)
    {
        $sql = 'SELECT COUNT(*) AS Total FROM Preinscripcion WHERE ID_Usuario = :idUsuario AND ID_Oferta = :idOferta';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $consulta->bindParam(':idOferta', $idOferta, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC)['Total'] > 0;
    }

    // RNE-4: si ya hay tantas preinscripciones confirmadas (Posicion_Lista NULL)
    // como el Cupo_Maximo de la oferta, la nueva pasa a lista de espera. Su
    // posicion es la cantidad de gente que ya esta esperando, mas uno.
    private function calcularPosicionLista($idOferta)
    {
        $sql = 'SELECT Cupo_Maximo FROM Oferta_Educativa WHERE ID_Oferta = :idOferta';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':idOferta', $idOferta, PDO::PARAM_INT);
        $consulta->execute();
        $cupoMaximo = $consulta->fetch(PDO::FETCH_ASSOC)['Cupo_Maximo'];

        $sql = 'SELECT COUNT(*) AS Total FROM Preinscripcion WHERE ID_Oferta = :idOferta AND Posicion_Lista IS NULL';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':idOferta', $idOferta, PDO::PARAM_INT);
        $consulta->execute();
        $confirmadas = $consulta->fetch(PDO::FETCH_ASSOC)['Total'];

        if ($confirmadas < $cupoMaximo) {
            return null;
        }

        $sql = 'SELECT COUNT(*) AS Total FROM Preinscripcion WHERE ID_Oferta = :idOferta AND Posicion_Lista IS NOT NULL';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':idOferta', $idOferta, PDO::PARAM_INT);
        $consulta->execute();
        $enListaDeEspera = $consulta->fetch(PDO::FETCH_ASSOC)['Total'];

        return $enListaDeEspera + 1;
    }

    public function crear($fecha, $cursoAnterior, $idUsuario, $idOferta)
    {
        if ($this->contarPreinscripcionesDeUsuario($idUsuario) >= 3) {
            return ['exito' => false, 'mensaje' => 'El usuario ya alcanzo el maximo de 3 preinscripciones.'];
        }

        if ($this->yaExistePreinscripcion($idUsuario, $idOferta)) {
            return ['exito' => false, 'mensaje' => 'El usuario ya esta preinscripto en esa oferta.'];
        }

        $posicionLista = $this->calcularPosicionLista($idOferta);

        $sql = 'INSERT INTO Preinscripcion (Fecha, Posicion_Lista, Curso_Anterior, ID_Usuario, ID_Oferta) VALUES (:fecha, :posicionLista, :cursoAnterior, :idUsuario, :idOferta)';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':fecha', $fecha);
        $consulta->bindParam(':cursoAnterior', $cursoAnterior);
        $consulta->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $consulta->bindParam(':idOferta', $idOferta, PDO::PARAM_INT);

        if ($posicionLista === null) {
            $consulta->bindValue(':posicionLista', null, PDO::PARAM_NULL);
        } else {
            $consulta->bindValue(':posicionLista', $posicionLista, PDO::PARAM_INT);
        }

        $consulta->execute();

        return ['exito' => true, 'id' => $this->conexion->lastInsertId(), 'posicionLista' => $posicionLista];
    }

    public function eliminar($id)
    {
        $sql = 'DELETE FROM Preinscripcion WHERE ID_Preinscripcion = :id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        if ($consulta->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}