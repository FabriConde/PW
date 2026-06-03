<?php
require_once __DIR__ . '/dataObject.php';
// Cada instancia de la clase Viajes se corresponde con una fila/registro de la tabla del mismo nombre
class Viajes extends DataObject {
    protected $datosViaje = array(
    "destino" => "",
    "fecha-inicio" => "",
    "fecha-fin" => "",
    "descripcion" => "",
    "descripcion_larga" => "",
    "precio" => "",
    "incluye" => "",
    "alojamientos" => "",
    "continente" => "",
    "pais" => "",
    "imagen" => "");
    
    public static function insertarViaje( $datosViaje ) {
        $conexion = parent::conectar();
        $sql = "INSERT INTO " . VIAJES . " (destino, fecha_inicio, fecha_fin, descripcion_corta, descripcion_larga, precio, incluye, alojamientos, continente, pais, imagen) VALUES (:destino, :fecha_inicio, :fecha_fin, :descripcion_corta, :descripcion_larga, :precio, :incluye, :alojamientos, :continente, :pais, :imagen)";
        try {
            $st = $conexion->prepare( $sql );
            $st->bindValue( ":destino", $datosViaje['destino'], PDO::PARAM_STR );
            $st->bindValue( ":fecha_inicio", $datosViaje['fecha-inicio'], PDO::PARAM_STR );
            $st->bindValue( ":fecha_fin", $datosViaje['fecha-fin'], PDO::PARAM_STR );
            $st->bindValue( ":descripcion_corta", $datosViaje['descripcion'], PDO::PARAM_STR );
            $st->bindValue( ":descripcion_larga", $datosViaje['descripcion_larga'], PDO::PARAM_STR );
            $st->bindValue( ":precio", $datosViaje['precio'], PDO::PARAM_STR );
            $st->bindValue( ":incluye", $datosViaje['incluye'], PDO::PARAM_STR );
            $st->bindValue( ":alojamientos", $datosViaje['alojamientos'], PDO::PARAM_STR );
            $st->bindValue( ":continente", $datosViaje['continente'], PDO::PARAM_STR );
            $st->bindValue( ":pais", $datosViaje['pais'], PDO::PARAM_STR );
            $st->bindValue( ":imagen", $datosViaje['imagen'], PDO::PARAM_STR );
            $resultado = $st->execute();
            parent::desconectar( $conexion );
            return $resultado;
        } catch ( PDOException $e ) {
            parent::desconectar( $conexion );
            throw new Exception( "Error al insertar el viaje: " . $e->getMessage() );
        }
    }

    public static function obtenerViajes( $filaInicio, $por_pagina ) {
        $conexion = parent::conectar();
        try {
            $sql = "SELECT SQL_CALC_FOUND_ROWS id, destino, fecha_inicio, fecha_fin, descripcion_corta, precio, imagen FROM " . VIAJES . " ORDER BY fecha_inicio DESC LIMIT :filaInicio, :por_pagina";
            $st = $conexion->prepare( $sql );
            $st->bindValue( ":filaInicio", (int)$filaInicio, PDO::PARAM_INT );
            $st->bindValue( ":por_pagina", (int)$por_pagina, PDO::PARAM_INT );
            $st->execute();
            $filas = $st->fetchAll( PDO::FETCH_ASSOC );

            // Obtener el total devuelto por SQL_CALC_FOUND_ROWS
            $st2 = $conexion->query( "SELECT FOUND_ROWS() AS total" );
            $resultado = $st2->fetch( PDO::FETCH_ASSOC );
            $total = isset( $resultado['total'] ) ? (int)$resultado['total'] : 0;

            parent::desconectar( $conexion );
            return array( $filas, $total );
        } catch ( PDOException $e ) {
            parent::desconectar( $conexion );
            throw new Exception( "Error al obtener viajes: " . $e->getMessage() );
        }
    }

}
?>