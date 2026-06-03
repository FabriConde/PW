<?php
require_once __DIR__ . '/dataObject.php';
// Cada instancia de la clase Usuario se corresponde con una fila/registro de la tabla del mismo nombre
class Usuario extends DataObject {
    protected $datosRegistro = array(
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
    
    public static function insertarUsuario( $datosRegistro ) {
        $conexion = parent::conectar();
        $sql = "INSERT INTO " . USUARIOS . " (nombre, apellidos, fecha_nacimiento, edad, dni, telefono, email, usuario, password, foto, genero, nacionalidad, destino, tipo_viaje, acompanantes, comentarios, web, condiciones, admin) VALUES (:nombre, :apellidos, :fecha_nacimiento, :edad, :dni, :telefono, :email, :usuario, :password, :foto, :genero, :nacionalidad, :destino, :tipo_viaje, :acompanantes, :comentarios, :web, :condiciones, :admin)";
        try {
            $st = $conexion->prepare( $sql );
            $st->bindValue( ":nombre", $datosRegistro['nombre'], PDO::PARAM_STR );
            $st->bindValue( ":apellidos", $datosRegistro['apellidos'], PDO::PARAM_STR );
            $st->bindValue( ":fecha_nacimiento", $datosRegistro['fecha-nacimiento'], PDO::PARAM_STR );
            $st->bindValue( ":edad", $datosRegistro['edad'], PDO::PARAM_INT );
            $st->bindValue( ":dni", $datosRegistro['dni'], PDO::PARAM_STR );
            $st->bindValue( ":telefono", $datosRegistro['telefono'], PDO::PARAM_STR );
            $st->bindValue( ":email", $datosRegistro['email'], PDO::PARAM_STR );
            $st->bindValue( ":usuario", $datosRegistro['usuario'], PDO::PARAM_STR );
            $st->bindValue( ":password", $datosRegistro['password'], PDO::PARAM_STR );
            $st->bindValue( ":foto", $datosRegistro['foto'], PDO::PARAM_STR );
            $st->bindValue( ":genero", $datosRegistro['genero'], PDO::PARAM_STR );
            $st->bindValue( ":nacionalidad", $datosRegistro['nacionalidad'], PDO::PARAM_STR );
            $st->bindValue( ":destino", $datosRegistro['destino'], PDO::PARAM_STR );
            $st->bindValue( ":tipo_viaje", $datosRegistro['tipo-viaje'], PDO::PARAM_STR );
            $st->bindValue( ":acompanantes", $datosRegistro['acompanantes'], PDO::PARAM_INT );
            $st->bindValue( ":comentarios", $datosRegistro['comentarios'], PDO::PARAM_STR );
            $st->bindValue( ":web", $datosRegistro['web'], PDO::PARAM_STR );
            $st->bindValue( ":condiciones", $datosRegistro['condiciones'], PDO::PARAM_BOOL );
            $st->bindValue( ":admin", $datosRegistro['admin'], PDO::PARAM_BOOL );
            $resultado = $st->execute();
            parent::desconectar( $conexion );
            return $resultado;
        } catch ( PDOException $e ) {
            parent::desconectar( $conexion );
            throw new Exception( "Error al insertar el usuario: " . $e->getMessage() );
        }
    }

    protected $datosLogin = array(
    "email" => "",
    "password" => "");
    
    public static function logearUsuario( $datosLogin ) {
        $conexion = parent::conectar();
        $sql = "SELECT * FROM " . USUARIOS . " WHERE email = :email";
        try {
            $st = $conexion->prepare( $sql );
            $st->bindValue( ":email", $datosLogin['email'], PDO::PARAM_STR );
            $st->execute();
            $usuario = $st->fetch(PDO::FETCH_ASSOC);
            parent::desconectar( $conexion );
            if ( $usuario && password_verify($datosLogin['password'], $usuario['password'])) {
                return $usuario;
            }
            return false;
        } catch ( PDOException $e ) {
            parent::desconectar( $conexion );
            throw new Exception( "Error al logear el usuario: " . $e->getMessage() );
        }
    }

}
?>