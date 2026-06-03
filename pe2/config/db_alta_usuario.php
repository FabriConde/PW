<?php
require_once ('dataObject.php');
// Cada instancia de la clase Usuario se corresponde con una fila/registro de la tabla del mismo nombre
    class Usuario extends DataObject {
    protected $datos = array(
    "nombre" => "",
    "apellidos" => "",
    "fecha-nacimiento" => "",
    "edad" => "",
    "dni" => "",
    "telefono" => "",
    "email" => "",
    "usuario" => "",
    "password" => "",
    "foto" => "",
    "genero" => "",
    "nacionalidad" => "",
    "destino" => "",
    "tipo-viaje" => "",
    "acompanantes" => "",
    "comentarios" => "",
    "web" => "",
    "condiciones" => false,
    "admin" => false);
    
    public static function insertarUsuario( $datos ) {
        $conexion = parent::conectar();
        $sql = "INSERT INTO " . USUARIOS . " (nombre, apellidos, fecha_nacimiento, edad, dni, telefono, email, usuario, password, foto, genero, nacionalidad, destino, tipo_viaje, acompanantes, comentarios, web, condiciones, admin) VALUES (:nombre, :apellidos, :fecha_nacimiento, :edad, :dni, :telefono, :email, :usuario, :password, :foto, :genero, :nacionalidad, :destino, :tipo_viaje, :acompanantes, :comentarios, :web, :condiciones, :admin)";
        try {
            $st = $conexion->prepare( $sql );
            $st->bindValue( ":nombre", $datos['nombre'], PDO::PARAM_STR );
            $st->bindValue( ":apellidos", $datos['apellidos'], PDO::PARAM_STR );
            $st->bindValue( ":fecha_nacimiento", $datos['fecha-nacimiento'], PDO::PARAM_STR );
            $st->bindValue( ":edad", $datos['edad'], PDO::PARAM_INT );
            $st->bindValue( ":dni", $datos['dni'], PDO::PARAM_STR );
            $st->bindValue( ":telefono", $datos['telefono'], PDO::PARAM_STR );
            $st->bindValue( ":email", $datos['email'], PDO::PARAM_STR );
            $st->bindValue( ":usuario", $datos['usuario'], PDO::PARAM_STR );
            $st->bindValue( ":password", $datos['password'], PDO::PARAM_STR );
            $st->bindValue( ":foto", $datos['foto'], PDO::PARAM_STR );
            $st->bindValue( ":genero", $datos['genero'], PDO::PARAM_STR );
            $st->bindValue( ":nacionalidad", $datos['nacionalidad'], PDO::PARAM_STR );
            $st->bindValue( ":destino", $datos['destino'], PDO::PARAM_STR );
            $st->bindValue( ":tipo_viaje", $datos['tipo-viaje'], PDO::PARAM_STR );
            $st->bindValue( ":acompanantes", $datos['acompanantes'], PDO::PARAM_INT );
            $st->bindValue( ":comentarios", $datos['comentarios'], PDO::PARAM_STR );
            $st->bindValue( ":web", $datos['web'], PDO::PARAM_STR );
            $st->bindValue( ":condiciones", $datos['condiciones'], PDO::PARAM_BOOL );
            $st->bindValue( ":admin", $datos['admin'], PDO::PARAM_BOOL );
            $resultado = $st->execute();
            parent::desconectar( $conexion );
            return $resultado;
        } catch ( PDOException $e ) {
            parent::desconectar( $conexion );
            throw new Exception( "Error al insertar el usuario: " . $e->getMessage() );
        }
    }

}
?>