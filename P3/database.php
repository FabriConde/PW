<?php
require_once ('dataObject.php');
// Cada instancia de la clase Libro se corresponde con una fila/registro de la tabla del mismo nombre
    class Libro extends DataObject {
    protected $datos = array(
    "isbn" => "",
    "titulo" => "",
    "autor" => "",
    "editorial" => "",
    "numPaginas" => "",
    "anio" => "");
    
    public static function obtenerLibros() {
        $conexion = parent::conectar();
        $sql = "SELECT * FROM " . LIBROS;
        try {
            $st = $conexion->prepare( $sql );
            $st->execute();
            $libros = array();
            foreach ( $st->fetchAll() as $fila ) {
                $libros[] = new Libro( $fila );
            }
            $st = $conexion->query( "SELECT found_rows() AS filasTotales" ); 
            /* Obtenemos la primera fila (en realidad, la única) de la salida de la
            query, almacenada en $st */
            $fila = $st->fetch();
            parent::desconectar( $conexion );
            return array( $libros, count($libros) );
        } catch ( PDOException $e ) {
        parent::desconectar( $conexion );
        die( "Consulta fallida: " . $e->getMessage() );
        }
    }
    public static function obtenerLibro( $isbn ) {
        $conexion = parent::conectar();
        $sql = "SELECT * FROM " . LIBROS . " WHERE isbn = :isbn";
        try {
            $st = $conexion->prepare( $sql );
            $st->bindValue( ":isbn", $isbn, PDO::PARAM_STR );
            $st->execute();
            $fila = $st->fetch();
            parent::desconectar( $conexion );
            if ( $fila ) return new Libro( $fila );
        } catch ( PDOException $e ) {
        parent::desconectar( $conexion );
        die( "Consulta fallada: " . $e->getMessage() );
        }
    }
    public static function insertarLibro( $datos) {
        $conexion = parent::conectar();
        $sql = "INSERT INTO " . LIBROS . " (isbn, titulo, autor, editorial, numPaginas, anio) VALUES (:isbn, :titulo, :autor, :editorial, :numPaginas, :anio)";
        try {
            $st = $conexion->prepare( $sql );
            $st->bindValue( ":isbn", $datos['isbn'], PDO::PARAM_STR );
            $st->bindValue( ":titulo", $datos['titulo'], PDO::PARAM_STR );
            $st->bindValue( ":autor", $datos['autor'], PDO::PARAM_STR );
            $st->bindValue( ":editorial", $datos['editorial'], PDO::PARAM_STR );
            $st->bindValue( ":numPaginas", $datos['numPaginas'], PDO::PARAM_INT );
            $st->bindValue( ":anio", $datos['anio'], PDO::PARAM_INT );
            $resultado = $st->execute();
            parent::desconectar( $conexion );
            return $resultado;
        } catch ( PDOException $e ) {
            parent::desconectar( $conexion );
            throw new Exception( "Error al insertar el libro: " . $e->getMessage() );
        }
    }
    public static function actualizarLibro( $datos) {
        $conexion = parent::conectar();
        $sql = "UPDATE " . LIBROS . " SET titulo = :titulo, autor = :autor, editorial = :editorial, numPaginas = :numPaginas, anio = :anio WHERE isbn = :isbn";
        try {
            $st = $conexion->prepare( $sql );
            $st->bindValue( ":isbn", $datos['isbn'], PDO::PARAM_STR );
            $st->bindValue( ":titulo", $datos['titulo'], PDO::PARAM_STR );
            $st->bindValue( ":autor", $datos['autor'], PDO::PARAM_STR );
            $st->bindValue( ":editorial", $datos['editorial'], PDO::PARAM_STR );
            $st->bindValue( ":numPaginas", $datos['numPaginas'], PDO::PARAM_INT );
            $st->bindValue( ":anio", $datos['anio'], PDO::PARAM_INT );
            $resultado = $st->execute();
            parent::desconectar( $conexion );
            return $resultado;
        } catch ( PDOException $e ) {
            parent::desconectar( $conexion );
            throw new Exception( "Error al actualizar el libro: " . $e->getMessage() );
        }
    }
    // Aquí también se meterían métodos que procesaran los campos de alguna forma.

}
?>