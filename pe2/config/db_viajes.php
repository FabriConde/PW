<?php
require_once __DIR__ . '/dataObject.php';
// Cada instancia de la clase Viajes se corresponde con una fila/registro de la tabla del mismo nombre
class Viajes extends DataObject {
    protected $datosViaje = array(
    "destino" => "",
    "fecha-inicio" => "",
    "fecha-fin" => "",
    "descripcion_corta" => "",
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
            $st->bindValue( ":descripcion_corta", $datosViaje['descripcion_corta'], PDO::PARAM_STR );
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

    public static function obtenerViajePorId( $idViaje ) {
        $conexion = parent::conectar();
        try {
            $sql = "SELECT id, destino, fecha_inicio, fecha_fin, descripcion_corta, descripcion_larga, precio, incluye, alojamientos, continente, pais, imagen FROM " . VIAJES . " WHERE id = :id LIMIT 1";
            $st = $conexion->prepare( $sql );
            $st->bindValue( ":id", (int)$idViaje, PDO::PARAM_INT );
            $st->execute();
            $resultado = $st->fetch( PDO::FETCH_ASSOC );
            parent::desconectar( $conexion );
            /* if ( $resultado ) {
                return array(
                    'id' => $resultado['id'],
                    'destino' => $resultado['destino'],
                    'fecha-inicio' => $resultado['fecha_inicio'],
                    'fecha-fin' => $resultado['fecha_fin'],
                    'descripcion_corta' => $resultado['descripcion_corta'],
                    'descripcion_larga' => $resultado['descripcion_larga'],
                    'precio' => $resultado['precio'],
                    'incluye' => $resultado['incluye'],
                    'alojamientos' => $resultado['alojamientos'],
                    'continente' => $resultado['continente'],
                    'pais' => $resultado['pais'],
                    'imagen' => $resultado['imagen']
                );
            } */
            if ( $resultado ) {
                return $resultado;
            }
            return null;
        } catch ( PDOException $e ) {
            parent::desconectar( $conexion );
            throw new Exception( "Error al obtener el viaje: " . $e->getMessage() );
        }
    }

    public static function actualizarViaje( $idViaje, $datosViaje ) {
        $conexion = parent::conectar();
        $sql = "UPDATE " . VIAJES . " SET destino = :destino, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, descripcion_corta = :descripcion_corta, descripcion_larga = :descripcion_larga, precio = :precio, incluye = :incluye, alojamientos = :alojamientos, continente = :continente, pais = :pais, imagen = :imagen WHERE id = :id";
        try {
            $st = $conexion->prepare( $sql );
            $st->bindValue( ":destino", $datosViaje['destino'], PDO::PARAM_STR );
            $st->bindValue( ":fecha_inicio", $datosViaje['fecha_inicio'], PDO::PARAM_STR );
            $st->bindValue( ":fecha_fin", $datosViaje['fecha_fin'], PDO::PARAM_STR );
            $st->bindValue( ":descripcion_corta", $datosViaje['descripcion_corta'], PDO::PARAM_STR );
            $st->bindValue( ":descripcion_larga", $datosViaje['descripcion_larga'], PDO::PARAM_STR );
            $st->bindValue( ":precio", $datosViaje['precio'], PDO::PARAM_STR );
            $st->bindValue( ":incluye", $datosViaje['incluye'], PDO::PARAM_STR );
            $st->bindValue( ":alojamientos", $datosViaje['alojamientos'], PDO::PARAM_STR );
            $st->bindValue( ":continente", $datosViaje['continente'], PDO::PARAM_STR );
            $st->bindValue( ":pais", $datosViaje['pais'], PDO::PARAM_STR );
            $st->bindValue( ":imagen", $datosViaje['imagen'], PDO::PARAM_STR );
            $st->bindValue( ":id", $idViaje, PDO::PARAM_INT );
            $resultado = $st->execute();
            parent::desconectar( $conexion );
            return $resultado;
        } catch ( PDOException $e ) {
            parent::desconectar( $conexion );
            throw new Exception( "Error al actualizar el viaje: " . $e->getMessage() );
        }
    }

    public static function delete( $idViaje ) {
        $conexion = parent::conectar();
        $sql = "DELETE FROM " . VIAJES . " WHERE id = :id";
        try {
            $st = $conexion->prepare( $sql );
            $st->bindValue( ":id", $idViaje, PDO::PARAM_INT );
            $st->execute();
            parent::desconectar( $conexion );
            return true;
        } catch ( PDOException $e ) {
            parent::desconectar( $conexion );
            throw new Exception( "Error al eliminar el viaje: " . $e->getMessage() );
        }
    }
    
    public static function obtenerViajesPorContinenteYPais( $continente, $pais, $filaInicio, $por_pagina ) {
        $conexion = parent::conectar();
        try {
            // La búsqueda por continente y país siempre se pagina
            $sql = "SELECT SQL_CALC_FOUND_ROWS id, destino, fecha_inicio, fecha_fin, descripcion_corta, descripcion_larga, precio, incluye, alojamientos, continente, pais, imagen FROM " . VIAJES . " WHERE LOWER(continente) = :continente AND LOWER(pais) = :pais ORDER BY fecha_inicio DESC LIMIT :filaInicio, :por_pagina";
            $st = $conexion->prepare( $sql );
            $st->bindValue(":continente", mb_strtolower($continente, 'UTF-8'), PDO::PARAM_STR);
            $st->bindValue(":pais", mb_strtolower($pais, 'UTF-8'), PDO::PARAM_STR);
            $st->bindValue(":filaInicio", (int)$filaInicio, PDO::PARAM_INT);
            $st->bindValue(":por_pagina", (int)$por_pagina, PDO::PARAM_INT);
            $st->execute();
            $filas = $st->fetchAll( PDO::FETCH_ASSOC );

            // Obtener total con FOUND_ROWS
            $st2 = $conexion->query( "SELECT FOUND_ROWS() AS total" );
            $resultado = $st2->fetch( PDO::FETCH_ASSOC );
            $total = isset( $resultado['total'] ) ? (int)$resultado['total'] : 0;
            parent::desconectar( $conexion );
            /* if ( $resultado ) {
                return array(
                    'id' => $resultado['id'],
                    'destino' => $resultado['destino'],
                    'fecha-inicio' => $resultado['fecha_inicio'],
                    'fecha-fin' => $resultado['fecha_fin'],
                    'descripcion_corta' => $resultado['descripcion_corta'],
                    'descripcion_larga' => $resultado['descripcion_larga'],
                    'precio' => $resultado['precio'],
                    'incluye' => $resultado['incluye'],
                    'alojamientos' => $resultado['alojamientos'],
                    'continente' => $resultado['continente'],
                    'pais' => $resultado['pais'],
                    'imagen' => $resultado['imagen']
                );
            } */
            // Siempre devolver array(filas, total)
            if ( $filas ) {
                return array( $filas, $total );
            }
            return array( array(), 0 );
        } catch ( PDOException $e ) {
            parent::desconectar( $conexion );
            throw new Exception( "Error al obtener el viaje: " . $e->getMessage() );
        }
    }
}
?>