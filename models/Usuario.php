<?php

namespace Model;

class Usuario extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellidos', 'telefono', 'password', 'email', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellidos;
    public $telefono;
    public $password;
    public $email;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []) {

        // si '$args['id']' no esta definido se le da el valor 'null'

        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
    }

    // Mensajes de validación para la creación de una cuenta
    public function validarNuevaCuenta() {
        if(!$this -> nombre) {
            self::$alertas['error'][] = 'El nombre del cliente es obligatorio';
        }
        if(!$this -> apellidos) {
            self::$alertas['error'][] = 'Los apellidos del cliente son obligatorios';
        }
        if(!$this -> telefono) {
            self::$alertas['error'][] = 'El teléfono del cliente es obligatorio';
        }
        if(!$this -> email) {
            self::$alertas['error'][] = 'El email del cliente es obligatorio';
        }
        if(!$this -> password) {
            self::$alertas['error'][] = 'El password del cliente es obligatorio';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password del cliente debe contener minímo 6 caracteres';
        }
        

        return self::$alertas;
    }

    public function validarLogin() {
        if (!$this->email) {
            self::$alertas['error'][] = 'El email del cliente es obigatorio';
        }
        if(!$this -> password) {
            self::$alertas['error'][] = 'El password del cliente es obligatorio';
        }

        return self::$alertas;
    }

    public function validarEmail() {
        if (!$this->email) {
            self::$alertas['error'][] = 'El email del cliente es obigatorio';
        }

        return self::$alertas;
    }

    public function validarPassword() {
        if (!$this->password) {
            self::$alertas['error'][] = 'El password del cliente es obigatorio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password del cliente debe contener minímo 6 caracteres';
        }

        return self::$alertas;
    }

    public function existeUsuario() {
        $query = " SELECT * FROM  " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado->num_rows){
            self::$alertas['error'][] = 'El usuario ya está registrado';
        }

        return $resultado;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken() {
        $this->token = uniqid();
    }

    public function comprobarPasswordAndVerificado($password) {
        $resultado = password_verify($password, $this->password);

        if (!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = 'Password incorrecto o tu cuenta aún no ha sido confirmada';
        } else {
            return true;
        }
        // debuguear($resultado);
    }
};