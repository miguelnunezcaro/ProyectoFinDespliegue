<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router) {

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if (empty($alertas)) {
                // Comprueba que exista el usuario
                $usuario = Usuario::where('email', $auth->email);

                if ($usuario) {
                    // Verifica el password
                    if($usuario->comprobarPasswordAndVerificado($auth->password)) {
                        // Autenticar el usuario
                        session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . ' ' . $usuario->apellidos;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        // Redireccionamiento 

                        if ($usuario->admin === '1') {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        } else {
                            header('Location: /cita');                         
                        }

                        debuguear($_SESSION);
                    }
                } else {
                    Usuario::setAlerta('error','Usuario no encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        
        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }
    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
    public static function olvide(Router $router) {

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if (empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);

                if ($usuario && $usuario->confirmado === '1') {

                    // Generar un token

                    $usuario->crearToken();
                    $usuario->guardar();

                    

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->apellidos, $usuario->token);
                    $email->enviarInstrucciones();


                    // Alerta de exito

                    Usuario::setAlerta('exito','Revisa tu email');
                    

                } else {

                    Usuario::setAlerta('error','El correo no existe o el usuario no está confirmado');
                }
            } 
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/olvidarPassword', [
            'alertas' => $alertas
        ]);
    }
    public static function recuperar(Router $router) {

        $alertas = [];
        $error = false;

        $token = s($_GET['token']);

        // Buscar usuario por su token

        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            Usuario::setAlerta('error','Token no válido');
            $error = true;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

           // Leer el nuevo password y guardarlo

            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if (empty($alertas)) {

                $usuario->password = null;   
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->guardar();

                if ($resultado) {
                    header('Location: /');
                }
            }
            
        }

        $alertas = Usuario::getAlertas();
        
        $router->render('auth/recuperarPassword', [
            'alertas' => $alertas,
            'error' => $error
        ]);
    }
    public static function crear(Router $router) {

        $usuario = new Usuario($_POST);

        // Alertas vacías

        $alertas = [];

        // El método $_SERVER['REQUEST_METHOD'] 
        // se utiliza para obtener el método de solicitud HTTP utilizado para acceder a la página actual, ya sea POST, GET, PUT o DELETE.

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario -> sincronizar($_POST);
            $alertas = $usuario -> validarNuevaCuenta();

            // Revisar que alerta este vacio 

            if(empty($alertas)) {
               
                // Verificar que el usuario no este registrado

                $resultado = $usuario->existeUsuario();

                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();

                    // Generar un token único
                    $usuario ->crearToken();

                    // Enviar el email

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->apellidos, $usuario->token);

                    $email->enviarConfirmacion();

                    // Crear el usuario

                    $resultado = $usuario->guardar();

                    if($resultado) {
                        header('Location: /mensaje');
                    }

                   
                    debuguear($usuario);
                }
            }
        }
        
        $router->render('auth/crearCuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router) {
        $router->render('auth/mensaje', [
            
        ]);
    }

    public static function confirmar(Router $router) {

        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            // Mostramos el mensaje de error si el token no es válido.
            Usuario::setAlerta('error', 'El token no es válido');
        } else {
            // Si el token es válido, actualizamos el registro en la base de datos y mostramos el mensaje de éxito.
            $usuario -> confirmado = '1';
            $usuario -> token = null;
            $usuario -> guardar();
            Usuario::setAlerta('exito', 'La cuenta ha sido comprobada correctamente');
        }

        //Obtener alertas.
        $alertas = Usuario::getAlertas();

        // Renderizar la vista.
        $router->render('auth/confirmarCuenta', [
            'alertas' => $alertas
        ]);
    }
}